<?php

namespace App\Http\Controllers\Examiner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Examiner;
class ExaminerCon extends Controller
{
    //
    public function index() {
    	echo Examiner::all();
    }
    public function add(Request $req) {
    	$examiner = new Examiner;
    	echo $examiner->create($req->all());
    }
    public function edit(Request $req) {
    	$examiner = Examiner::where('id', $req->id)->get();
    	echo $examiner;
    }
    
    public function edited(Request $req) {
    	$examiner = Examiner::find($req->id);
    	$examiner->name = $req->name;
    	echo $examiner->save();
    }
    public function delete(Request $req) {
    	echo Examiner::destroy($req->id);
    }
    
}
