<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;
use App\Exam;

class studentCon extends Controller
{
    //
	public function index() {
    	echo Student::orderBy('first_name', 'ASC')->get();
    }
    public function completeStds() {
    	echo Student::orderBy('first_name', 'ASC')->where('completed_or_not', '1')->get();
    }
    public function add(Request $req) {
    	$student = new Student;
    	foreach ($req->except(['practical_test_pf_1', 'practical_test_pf_2', 'practical_test_pf_3', 'practical_test_pf_4', 'practical_test_pf_5', 'practical_test_pf_6', 'practical_test_pf_7', 'examiners_name_1', 'examiners_name_2', 'examiners_name_3', 'examiners_name_4', 'examiners_name_5', 'examiners_name_6', 'examiners_name_7', 'district_1', 'district_2', 'district_3', 'district_4', 'district_5', 'district_6', 'district_7', 'town_1', 'town_2', 'town_3', 'town_4', 'town_5', 'town_6', 'town_7', 'total_pris']) as $key => $value) {
    		$student->$key = $value;
    	}
        echo $student->save();
        // theory
        if ($req->theory_test_date_no_1 && $req->theory_test_passorfail_no_1) {
            $e1 = Exam::create(['theory_no' => '1', 'theory_date' => $req->theory_test_date_no_1, 'theory_pass' => $req->theory_test_passorfail_no_1, '', 'student_id' => $student->id]);
        }
        if ($req->theory_test_date_no_2 && $req->theory_test_passorfail_no_2) {
            $e2 = Exam::create(['theory_no' => '2', 'theory_date' => $req->theory_test_date_no_2, 'theory_pass' => $req->theory_test_passorfail_no_2, '', 'student_id' => $student->id]);
        }
        if ($req->theory_test_date_no_3 && $req->theory_test_passorfail_no_3) {
            $e3 = Exam::create(['theory_no' => '3', 'theory_date' => $req->theory_test_date_no_3, 'theory_pass' => $req->theory_test_passorfail_no_3, '', 'student_id' => $student->id]);
        }
        if ($req->theory_test_date_no_4 && $req->theory_test_passorfail_no_4) {
            $e4 = Exam::create(['theory_no' => '4', 'theory_date' => $req->theory_test_date_no_4, 'theory_pass' => $req->theory_test_passorfail_no_4, '', 'student_id' => $student->id]);
        }
        if ($req->theory_test_date_no_5 && $req->theory_test_passorfail_no_5) {
            $e5 = Exam::create(['theory_no' => '5', 'theory_date' => $req->theory_test_date_no_5, 'theory_pass' => $req->theory_test_passorfail_no_5, '', 'student_id' => $student->id]);
        }
        if ($req->theory_test_date_no_6 && $req->theory_test_passorfail_no_6) {
            $e6 = Exam::create(['theory_no' => '6', 'theory_date' => $req->theory_test_date_no_6, 'theory_pass' => $req->theory_test_passorfail_no_6, '', 'student_id' => $student->id]);
        }
        if ($req->theory_test_date_no_7 && $req->theory_test_passorfail_no_7) {
            $e7 = Exam::create(['theory_no' => '7', 'theory_date' => $req->theory_test_date_no_7, 'theory_pass' => $req->theory_test_passorfail_no_7, '', 'student_id' => $student->id]);
        }
        // practical
        if ($req->practical_test_date_no_1 && $req->practical_test_pf_1 && $req->examiners_name_1 && $req->district_1 && $req->town_1) {
            Exam::where(['student_id' => $student->id, 'theory_no' => '1'])->update(['practical_date' => $req->practical_test_date_no_1, 'town' => $req->town_1, 'distinct' => $req->district_1, 'practical_pass' => $req->practical_test_pf_1, 'examiner_id' => $req->examiners_name_1, 'practical_no' => '1']);
        }
        if ($req->practical_test_date_no_2 && $req->practical_test_pf_2 && $req->examiners_name_2 && $req->district_2 && $req->town_2) {
            Exam::where(['student_id' => $student->id, 'theory_no' => '2'])->update(['practical_date' => $req->practical_test_date_no_2, 'town' => $req->town_2, 'distinct' => $req->district_2, 'practical_pass' => $req->practical_test_pf_2, 'examiner_id' => $req->examiners_name_2, 'practical_no' => '2']);
        }
        if ($req->practical_test_date_no_3 && $req->practical_test_pf_3 && $req->examiners_name_3 && $req->district_3 && $req->town_3) {
            Exam::where(['student_id' => $student->id, 'theory_no' => '3'])->update(['practical_date' => $req->practical_test_date_no_3, 'town' => $req->town_3, 'distinct' => $req->district_3, 'practical_pass' => $req->practical_test_pf_3, 'examiner_id' => $req->examiners_name_3, 'practical_no' => '3']);
        }
        if ($req->practical_test_date_no_4 && $req->practical_test_pf_4 && $req->examiners_name_4 && $req->district_4 && $req->town_4) {
            Exam::where(['student_id' => $student->id, 'theory_no' => '4'])->update(['practical_date' => $req->practical_test_date_no_4, 'town' => $req->town_4, 'distinct' => $req->district_4, 'practical_pass' => $req->practical_test_pf_4, 'examiner_id' => $req->examiners_name_4, 'practical_no' => '4']);
        }
        if ($req->practical_test_date_no_5 && $req->practical_test_pf_5 && $req->examiners_name_5 && $req->district_5 && $req->town_5) {
            Exam::where(['student_id' => $student->id, 'theory_no' => '5'])->update(['practical_date' => $req->practical_test_date_no_5, 'town' => $req->town_5, 'distinct' => $req->district_5, 'practical_pass' => $req->practical_test_pf_5, 'examiner_id' => $req->examiners_name_5, 'practical_no' => '5']);
        }
        if ($req->practical_test_date_no_6 && $req->practical_test_pf_6 && $req->examiners_name_6 && $req->district_6 && $req->town_6) {
            Exam::where(['student_id' => $student->id, 'theory_no' => '6'])->update(['practical_date' => $req->practical_test_date_no_6, 'town' => $req->town_6, 'distinct' => $req->district_6, 'practical_pass' => $req->practical_test_pf_6, 'examiner_id' => $req->examiners_name_6, 'practical_no' => '6']);
        }
        if ($req->practical_test_date_no_7 && $req->practical_test_pf_7 && $req->examiners_name_7 && $req->district_7 && $req->town_7) {
            Exam::where(['student_id' => $student->id, 'theory_no' => '7'])->update(['practical_date' => $req->practical_test_date_no_7, 'town' => $req->town_7, 'distinct' => $req->district_7, 'practical_pass' => $req->practical_test_pf_7, 'examiner_id' => $req->examiners_name_7, 'practical_no' => '7']);
        }  
    }
    public function edit(Request $req) {
        $data['d1'] = Student::where('id', $req->id)->get();
    	$data['d2'] = Exam::where('student_id', $req->id)->get();
    	echo json_encode($data);
    }
    
    public function edited(Request $req) {
    	$student = Student::find($req->id);
    	foreach ($req->except(['practical_test_pf_1', 'practical_test_pf_2', 'practical_test_pf_3', 'practical_test_pf_4', 'practical_test_pf_5', 'practical_test_pf_6', 'practical_test_pf_7', 'examiners_name_1', 'examiners_name_2', 'examiners_name_3', 'examiners_name_4', 'examiners_name_5', 'examiners_name_6', 'examiners_name_7', 'district_1', 'district_2', 'district_3', 'district_4', 'district_5', 'district_6', 'district_7', 'town_1', 'town_2', 'town_3', 'town_4', 'town_5', 'town_6', 'town_7', 'total_pris']) as $key => $value) {
            $student->$key = $value;
        }
    	echo $student->save();
        // theory
        if ($req->theory_test_date_no_1 && $req->theory_test_passorfail_no_1) {
            
            if(!empty(Exam::where(['theory_no' => '1', 'student_id' => $req->id])->first()))
            {
               Exam::where(['theory_no' => '1', 'student_id' => $req->id])->update(['theory_date' => $req->theory_test_date_no_1, 'theory_pass' => $req->theory_test_passorfail_no_1]);
            }
            else
            {
                $e1 = Exam::create(['theory_no' => '1', 'theory_date' => $req->theory_test_date_no_1, 'theory_pass' => $req->theory_test_passorfail_no_1, '', 'student_id' => $student->id]);
            }
        }
        if ($req->theory_test_date_no_2 && $req->theory_test_passorfail_no_2) {
            if(!empty(Exam::where(['theory_no' => '2', 'student_id' => $req->id])->first()))
            {
               Exam::where(['theory_no' => '2', 'student_id' => $req->id])->update(['theory_date' => $req->theory_test_date_no_2, 'theory_pass' => $req->theory_test_passorfail_no_2]);
            }
            else
            {
                $e2 = Exam::create(['theory_no' => '2', 'theory_date' => $req->theory_test_date_no_2, 'theory_pass' => $req->theory_test_passorfail_no_2, '', 'student_id' => $student->id]);
            }
        }
        if ($req->theory_test_date_no_3 && $req->theory_test_passorfail_no_3) {
            // $e3 = Exam::create(['theory_no' => '3', 'theory_date' => $req->theory_test_date_no_3, 'theory_pass' => $req->theory_test_passorfail_no_3, '', 'student_id' => $student->id]);
            if(!empty(Exam::where(['theory_no' => '3', 'student_id' => $req->id])->first()))
            {
               Exam::where(['theory_no' => '3', 'student_id' => $req->id])->update(['theory_date' => $req->theory_test_date_no_3, 'theory_pass' => $req->theory_test_passorfail_no_3]);
            }
            else
            {
                $e3 = Exam::create(['theory_no' => '3', 'theory_date' => $req->theory_test_date_no_3, 'theory_pass' => $req->theory_test_passorfail_no_3, '', 'student_id' => $student->id]);
            }
        }
        if ($req->theory_test_date_no_4 && $req->theory_test_passorfail_no_4) {
            // $e4 = Exam::create(['theory_no' => '4', 'theory_date' => $req->theory_test_date_no_4, 'theory_pass' => $req->theory_test_passorfail_no_4, '', 'student_id' => $student->id]);
            if(!empty(Exam::where(['theory_no' => '4', 'student_id' => $req->id])->first()))
            {
               Exam::where(['theory_no' => '4', 'student_id' => $req->id])->update(['theory_date' => $req->theory_test_date_no_4, 'theory_pass' => $req->theory_test_passorfail_no_4]);
            }
            else
            {
                $e4 = Exam::create(['theory_no' => '4', 'theory_date' => $req->theory_test_date_no_4, 'theory_pass' => $req->theory_test_passorfail_no_4, '', 'student_id' => $student->id]);
            }
        }
        if ($req->theory_test_date_no_5 && $req->theory_test_passorfail_no_5) {
            // $e5 = Exam::create(['theory_no' => '5', 'theory_date' => $req->theory_test_date_no_5, 'theory_pass' => $req->theory_test_passorfail_no_5, '', 'student_id' => $student->id]);
            if(!empty(Exam::where(['theory_no' => '5', 'student_id' => $req->id])->first()))
            {
               Exam::where(['theory_no' => '5', 'student_id' => $req->id])->update(['theory_date' => $req->theory_test_date_no_5, 'theory_pass' => $req->theory_test_passorfail_no_5]);
            }
            else
            {
                $e5 = Exam::create(['theory_no' => '5', 'theory_date' => $req->theory_test_date_no_5, 'theory_pass' => $req->theory_test_passorfail_no_5, '', 'student_id' => $student->id]);
            }
        }
        if ($req->theory_test_date_no_6 && $req->theory_test_passorfail_no_6) {
            // $e6 = Exam::create(['theory_no' => '6', 'theory_date' => $req->theory_test_date_no_6, 'theory_pass' => $req->theory_test_passorfail_no_6, '', 'student_id' => $student->id]);
            if(!empty(Exam::where(['theory_no' => '6', 'student_id' => $req->id])->first()))
            {
               Exam::where(['theory_no' => '6', 'student_id' => $req->id])->update(['theory_date' => $req->theory_test_date_no_6, 'theory_pass' => $req->theory_test_passorfail_no_6]);
            }
            else
            {
                $e6 = Exam::create(['theory_no' => '6', 'theory_date' => $req->theory_test_date_no_6, 'theory_pass' => $req->theory_test_passorfail_no_6, '', 'student_id' => $student->id]);
            }
        }
        if ($req->theory_test_date_no_7 && $req->theory_test_passorfail_no_7) {
            // $e7 = Exam::create(['theory_no' => '7', 'theory_date' => $req->theory_test_date_no_7, 'theory_pass' => $req->theory_test_passorfail_no_7, '', 'student_id' => $student->id]);
            if(!empty(Exam::where(['theory_no' => '7', 'student_id' => $req->id])->first()))
            {
               Exam::where(['theory_no' => '7', 'student_id' => $req->id])->update(['theory_date' => $req->theory_test_date_no_7, 'theory_pass' => $req->theory_test_passorfail_no_7]);
            }
            else
            {
                $e7 = Exam::create(['theory_no' => '7', 'theory_date' => $req->theory_test_date_no_7, 'theory_pass' => $req->theory_test_passorfail_no_7, '', 'student_id' => $student->id]);
            }
        }
        // practical
        if ($req->practical_test_date_no_1 && $req->practical_test_pf_1 && $req->examiners_name_1 && $req->district_1 && $req->town_1) {
            Exam::where(['student_id' => $student->id, 'theory_no' => '1'])->update(['practical_date' => $req->practical_test_date_no_1, 'town' => $req->town_1, 'distinct' => $req->district_1, 'practical_pass' => $req->practical_test_pf_1, 'examiner_id' => $req->examiners_name_1,  'practical_no' => '1']);
        }
        if ($req->practical_test_date_no_2 && $req->practical_test_pf_2 && $req->examiners_name_2 && $req->district_2 && $req->town_2) {
            Exam::where(['student_id' => $student->id, 'theory_no' => '2'])->update(['practical_date' => $req->practical_test_date_no_2, 'town' => $req->town_2, 'distinct' => $req->district_2, 'practical_pass' => $req->practical_test_pf_2, 'examiner_id' => $req->examiners_name_2,  'practical_no' => '2']);
        }
        if ($req->practical_test_date_no_3 && $req->practical_test_pf_3 && $req->examiners_name_3 && $req->district_3 && $req->town_3) {
            Exam::where(['student_id' => $student->id, 'theory_no' => '3'])->update(['practical_date' => $req->practical_test_date_no_3, 'town' => $req->town_3, 'distinct' => $req->district_3, 'practical_pass' => $req->practical_test_pf_3, 'examiner_id' => $req->examiners_name_3,  'practical_no' => '3']);
        }
        if ($req->practical_test_date_no_4 && $req->practical_test_pf_4 && $req->examiners_name_4 && $req->district_4 && $req->town_4) {
            Exam::where(['student_id' => $student->id, 'theory_no' => '4'])->update(['practical_date' => $req->practical_test_date_no_4, 'town' => $req->town_4, 'distinct' => $req->district_4, 'practical_pass' => $req->practical_test_pf_4, 'examiner_id' => $req->examiners_name_4,  'practical_no' => '4']);
        }
        if ($req->practical_test_date_no_5 && $req->practical_test_pf_5 && $req->examiners_name_5 && $req->district_5 && $req->town_5) {
            Exam::where(['student_id' => $student->id, 'theory_no' => '5'])->update(['practical_date' => $req->practical_test_date_no_5, 'town' => $req->town_5, 'distinct' => $req->district_5, 'practical_pass' => $req->practical_test_pf_5, 'examiner_id' => $req->examiners_name_5,  'practical_no' => '5']);
        }
        if ($req->practical_test_date_no_6 && $req->practical_test_pf_6 && $req->examiners_name_6 && $req->district_6 && $req->town_6) {
            Exam::where(['student_id' => $student->id, 'theory_no' => '6'])->update(['practical_date' => $req->practical_test_date_no_6, 'town' => $req->town_6, 'distinct' => $req->district_6, 'practical_pass' => $req->practical_test_pf_6, 'examiner_id' => $req->examiners_name_6,  'practical_no' => '6']);
        }
        if ($req->practical_test_date_no_7 && $req->practical_test_pf_7 && $req->examiners_name_7 && $req->district_7 && $req->town_7) {
            Exam::where(['student_id' => $student->id, 'theory_no' => '7'])->update(['practical_date' => $req->practical_test_date_no_7, 'town' => $req->town_7, 'distinct' => $req->district_7, 'practical_pass' => $req->practical_test_pf_7, 'examiner_id' => $req->examiners_name_7,  'practical_no' => '7']);
        }  
    }
    public function delete(Request $req) {
    	// var_dump($req->id); die;
    	echo Student::destroy($req->id);
    }
}
