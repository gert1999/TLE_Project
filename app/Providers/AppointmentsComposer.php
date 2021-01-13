<?php


namespace App\Providers;


use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AppointmentsComposer
{
    public function compose(View $view)
    {
        if(Auth::check()) {
            $appointments = DB::table('appointments')
                ->join('students', 'appointments.student_id', '=', 'students.id')
                ->where('appointments.counselor_id', Auth::user()->id)
                ->where('start_time','>=','2020-01-01 14:00:00')
                ->where('appointments.attending', 1)
                ->paginate(5);



            $appointments2 = DB::table('appointments')
                ->join('students', 'appointments.student_id', '=', 'students.id')
                ->where('appointments.counselor_id', Auth::user()->id)
                ->where('appointments.attending', 1)
                ->where('start_time','>=','2020-01-01 14:00:00')
                ->count();
            //        $appointments = Carbon::createFromFormat('Y-m-d H:i:s', $appointments)->format('d/m/Y');

            $students_count2 = DB::table('students')
                ->join('appointments', 'students.id', '=', 'appointments.student_id')
                ->where('appointments.counselor_id', auth()->user()->id)
                ->where('appointments.start_time', Null)
                ->orWhere('appointments.start_time', '0000-00-00 00:00:00')
//            ->select('students.*')
                ->count();

            $counselors = Auth::user()->id;
            $avatar = //AVATAR HERE
            $view->with('appointments', $appointments);
            $view->with('appointments2', $appointments2);
            $view->with('counselors', $counselors);
            $view->with('students_count2', $students_count2);
        }
    }
}
