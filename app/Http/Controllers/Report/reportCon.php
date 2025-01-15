<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;
use App\Examiner;
use App\Exam;
use DB;

class reportCon extends Controller
{
    //
    public function comStd() {
    	echo Student::where('completed_or_not', '1')->orderBy('first_name', 'ASC')->get();
    }
    public function incomStd() {
    	echo Student::where('completed_or_not', '0')->orderBy('first_name', 'ASC')->get();
   	}
    public function genderStd() {
    	$gReport['mail'] = Student::where('gender', 'Han')->count();
    	$gReport['female'] = Student::where('gender', 'Hun')->count();
    	$gReport['total'] = Student::all()->count();
    	$gReport['mailAvr'] = ($gReport['mail'] * 100 ) / $gReport['total'];
    	$gReport['femaleAvr'] = ($gReport['female'] * 100 ) / $gReport['total'];

    	return response()->json($gReport);
    }
    public function passStd() {
	   echo Exam::join('students', 'exams.student_id', '=', 'students.id')->join('examiners', 'exams.examiner_id', '=', 'examiners.id')->get(['exams.*', 'students.first_name', 'students.last_name', 'examiners.name']);

    }
    public function occupStd() {
    	echo Student::orderBy('first_name', 'ASC')->get();
    }
    public function accountStd() {
        
    	$stds = Student::orderBy('first_name', 'ASC')->get();
        $count = 0;
        $fstds = [];
        foreach ($stds as $key => $std) {
            $fstds[$count] = $std;
            $fstds[$count]['full_name'] = $std['first_name'].' '.$std['last_name'];
            $count++;
        }
        echo json_encode($fstds);
    }
    public function printStd() {
    	echo Student::orderBy('first_name', 'ASC')->get();
    }
    public function examPass() {
        $data['all'] = Exam::join('examiners', 'exams.examiner_id', '=', 'examiners.id')->join('students', 'exams.student_id', '=', 'students.id')->groupBy('exams.examiner_id')->get(['exams.examiner_id', 'examiners.name', DB::raw('COUNT(exams.examiner_id) as count')]);
        $data['pass'] = Exam::join('examiners', 'exams.examiner_id', '=', 'examiners.id')->join('students', 'exams.student_id', '=', 'students.id')->where(['theory_pass' => 'pass', 'practical_pass' => 'pass'])->groupBy('exams.examiner_id')->get(['exams.examiner_id', 'examiners.name', DB::raw('COUNT(exams.examiner_id) as count')]);
        echo json_encode($data);
    }
    public function stdPass() {
        echo Student::orderBy('first_name', 'ASC')->get();
        
    }
    public function stdInactive() {
        echo Student::where('current_course_status', 'inactive')->get();
    }
    
    
}
