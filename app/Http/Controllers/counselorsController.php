<?php

namespace App\Http\Controllers;

use App\Feelings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class counselorsController extends Controller
{
    function index(){
        // main database request for the dashboard where data about all students linked to the logged in counselor are requested
        $students = DB::table('counselors')
            ->join('students', 'counselors.id', '=', 'students.counselor_id')
            ->where('students.counselor_id', auth()->user()->id)
            ->select('students.*')
            ->get();

        // a request that is necessary for the feelings request.
        // it is a first rather than a get so it will be usable in following requests
        $studentID = DB::table('counselors')
            ->join('students', 'counselors.id', '=', 'students.counselor_id')
            ->where('students.counselor_id', auth()->user()->id)
            ->first();

        //similar to students request but for all students.
        $studentNumber = DB::table('students')
            ->where('status', 'active')
            ->get();

        //extra request to enable paginating etc. without destroying other pieces of code
        $allStudents = DB::table('students')
            ->where('status', 'active')
            ->get();

        //a fix for when a teacher has no students assigned yet
        if($studentID== Null){
            $students = [];
            $feeling = [];
            $studentNumber = [];
            return view('dashboard', compact('students', 'feeling', 'studentNumber', 'allStudents'));


        }else {
            //will get the list of feelings out of the database for each student of the counselor
            $feelings = DB::table('feelings')
                //->where('student_id', $studentID->id)
                ->get();

//            dd($feelings);

            $feelingArray = [];
            $feelingID = [];
            // get the amount of students
            foreach ($studentNumber as $stuff) {
                $studentCount = $stuff->id;
            }
            $feeling = [];
            //make an array to count on with a size similar to the amount of students
            for ($c = 0; $c < $studentCount+1; $c++) {
                $feeling[] = 0;
            }
            //create a set of arrays that allow the feelings in the database to be linked to the corresponding students
            foreach ($feelings as $data) {
                $inbetween = $data->score;
                $IDbetween = $data->student_id;
                $feelingArray[] = $inbetween;
                $feelingID[] = $IDbetween;
            }
                //the code behind the warning signs. if a pupil fills in below 3 (sad faces) it adds one to the respective place in the feeling array
                //if the pupil fills in 3 or higher (mediocre to happy) it resets the respective place in the feeling array to 0
                if (count($feelingArray) >= 3) {
                    for ($i = 0; $i < count($feelingArray); $i++) {
                        if ($feelingArray[$i] < 3) {
                            $feeling[$feelingID[$i]] = $feeling[$feelingID[$i]] + 1;
                        } else {
                            $feeling[$feelingID[$i]] = 0;
                        }

                    }
                }

                foreach ($feelings as $test)
                {
                    $weirds = $test;
                    $weird[] = $weirds;
                }

            return view('dashboard', compact('students', 'feeling', 'studentNumber', 'allStudents', 'weird'));
        }
    }
    public function show($id){

//      main function of the student graph page
        // request the list of feelings from the respective student. the list will be displayed in sets of 8.
        //id is the id of the student of which the graph button was pressed
        $feeling = DB::table('feelings')
            ->where('student_id', $id)
            ->orderBy('id', 'DESC')
            ->paginate(8);

        //failsave for when the student has not used the app yet
        if($feeling === null){
            abort(404, "Dit pagina is helaas niet gevonden");
        }
        //request to get the information about the student so name and such can be shown.
        $student = DB::table('students')
            ->where('id', $id)
            ->get();

        return view('show', compact('feeling', 'id', 'student'));
    }

    //the function for when the delete button is pressed
    public function delete($id){

//       change the status in the database from active to inactive.
//       this way the student is deleted temporarily so they can be recovered when necessary
        DB::table('students')
            ->where('id', $id)
            ->update(['status' => 'inactive']);

        return redirect('/dashboard');
    }
    //opposite of delete
    public function active($id){

//        student is set on active again and will reappear in the student lists
        DB::table('students')
            ->where('id', $id)
            ->update(['status' => 'active']);

        return redirect('/dashboard');
    }
    //the data request function for the info pages
    public function info($id){

        //the student info will be requested. id variable is the id of the student of which the info button was pressed.
        $students = DB::table('students')
            ->where('id', $id)
            ->get();

        return view('info', compact(  'students'));
    }
}
