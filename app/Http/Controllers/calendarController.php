<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class calendarController extends Controller
{
    // Agenda index page
    public function index(){

        return view('agenda.calendar');
    }

    // Agenda load appointments
    public function load(){
        $data = array();

        // Get events from database
        $events= DB::table('students')
            ->join('appointments', 'appointments.student_id', '=', 'students.id')
            ->where('appointments.counselor_id', auth()->user()->id)
            ->where('appointments.attending', 1)
            ->get();

        // Make array for appointments
        foreach($events as $row)
        {
            $data[] = array(
                'id'   => $row->id,
                'student_id'   => $row->student_id,
                'title'   => $row->first_name. ' ' .$row->last_name,
                'start'   => $row->start_time,
                'end'   => $row->end_time
            );
        }

        echo json_encode($data);
    }

    // Insert appointment in database
    public function insert(Request $request ){
        $datum = $request->input('datum');
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');

        $datum_tijd_start = $datum. ' ' .$start_time;
        $datum_tijd_end = $datum. ' ' .$end_time;

        $student_id_add = $request->input('student_id_add');

        DB::table('appointments')->insert([
            ['student_id' => $student_id_add, 'counselor_id' => auth()->user()->id, 'attending' => 1, 'subject' => '', 'start_time' => $datum_tijd_start, 'end_time' => $datum_tijd_end]
        ]);

        return redirect('/dashboard/calendar');
    }

    // Search student from database
    function fetch(Request $request){
        if($request->get('query')){
            $query = $request->get('query');

            $data = DB::table('students')
                    ->where('first_name', 'LIKE', "%{$query}%")
                    ->orWhere('last_name', 'LIKE', "%{$query}%")
                    ->get();

            $output = '<ul class="dropdown-menu" style="display:block;position: absolute;margin-top:-313px;width:94%;margin-left:10px;padding-left:10px;">';

            foreach($data as $row){
                $output .= '<li style="cursor:pointer;">' .$row->first_name. ' ' .$row->last_name. '</li><input type="text" placeholder="Enter student" value="' .$row->id. '" name="student_id_add" required autocomplete="off" hidden>';
            }

            $output .= '</ul>';
            echo $output;
        }
    }

    // Edit appointment
    function edit(Request $request){

        $start_time = $request->input('datum2'). ' ' .$request->input('start_time2');

        $end_time = $request->input('datum2'). ' ' .$request->input('end_time2');

        $student_id = $request->input('student_id3');

        DB::table('appointments')
            ->where('id',  $student_id)
            ->update(['start_time' => $start_time, 'end_time' => $end_time]);

        return redirect('/dashboard/calendar');
    }

    // Delete appointment from agenda
    function delete(Request $request){
        DB::table('appointments')->where('id', $request->input('student_id2'))->delete();

        return redirect('/dashboard/calendar');
    }

    // Appointment aanvragen accepteren
    function aangevraagd(){
        $students = DB::table('students')
            ->join('appointments', 'students.id', '=', 'appointments.student_id')
            ->where('appointments.counselor_id', auth()->user()->id)
            ->where('appointments.start_time', Null)
            ->orWhere('appointments.start_time', '0000-00-00 00:00:00')
            ->get();

        $students_count = DB::table('students')
            ->join('appointments', 'students.id', '=', 'appointments.student_id')
            ->where('appointments.counselor_id', auth()->user()->id)
            ->where('appointments.start_time', Null)
            ->orWhere('appointments.start_time', '0000-00-00 00:00:00')
            ->count();

        return view('gesprekken.aangevraagd', compact('students', 'students_count'));
    }

    // Appointment edit aanvragen to database
    function edit_aangevraagd(Request $request){
        $start_time_aangevraagd = $request->input('datum_aangevraagd'). ' ' .$request->input('start_time_aangevraagd');

        $end_time_aangevraagd = $request->input('datum_aangevraagd'). ' ' .$request->input('end_time_aangevraagd');

        $student_id_aangevraagd = $request->input('student_id_aangevraagd');

        DB::table('appointments')
            ->where('id',  $student_id_aangevraagd)
            ->update(['start_time' => $start_time_aangevraagd, 'end_time' => $end_time_aangevraagd, 'attending' => 1]);

        return redirect('/dashboard/gesprekken/aangevraagd');
    }
}
