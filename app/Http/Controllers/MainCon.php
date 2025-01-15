<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class MainCon extends Controller
{
    public function index()
    {
    	return view('index');
    }
    public function loginAttempt(Request $req)
    {
         if(Auth::attempt(['email' => $req->email, 'password' => $req->password ])) {
    	 	 // Auth::login(Auth::user(), true);
            return Auth::user();
            // echo 1;
            
    	 } 
    	 else{
    	 	echo 0;
    	 }
    }
    public function checkAdmin()
    {
    	// var_dump(Auth::check() );
    	// die;
        $user = [];
    	if(Auth::check() ){
			$user['uData'] = Auth::user();
			$user['isLogin'] = 0;
			if (!empty($user['uData'])) {
				$user['isLogin'] = 1;
			}
		}
    	echo json_encode($user);
	}
	public function logout(){
		Auth::logout();
	}
	public function profile(Request $req){
		$user = User::find(Auth::user()->id);
		$user->name = $req->name;
		$user->email = $req->email;
		$user->password = bcrypt($req->pass);
		echo $user->save();
	}
}

