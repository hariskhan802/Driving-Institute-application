<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['guard' => 'superadmin'], function(){
	
	Route::group(['prefix' => '/api/v1/'],function(){
		
		Route::group(['namespace' => 'Examiner', 'prefix' => 'examiner'],function(){
			Route::get('/list', 'ExaminerCon@index');
			Route::post('/add', 'ExaminerCon@add');
			Route::post('/edit', 'ExaminerCon@edit');
			Route::post('/edited', 'ExaminerCon@edited');
			Route::post('/delete', 'ExaminerCon@delete');
		});

		Route::group(['namespace' => 'Student', 'prefix' => 'student'],function(){
			Route::get('/list', 'studentCon@index');
			Route::post('/add', 'studentCon@add');
			Route::post('/complete', 'studentCon@completeStds');
			Route::post('/edit', 'studentCon@edit');
			Route::post('/edited', 'studentCon@edited');
			Route::post('/delete', 'studentCon@delete');
		});
		Route::group(['namespace' => 'Report', 'prefix' => 'report'],function(){
			Route::get('/com-std', 'reportCon@comStd');
			Route::get('/incom-std', 'reportCon@incomStd');
			Route::get('/gender-std', 'reportCon@genderStd');
			Route::get('/pass-std', 'reportCon@passStd');
			Route::get('/occup-std', 'reportCon@occupStd');
			Route::get('/account-std', 'reportCon@accountStd');
			Route::get('/print-std', 'reportCon@printStd');
			Route::get('/exam-pass', 'reportCon@examPass');
			Route::get('/inactive-pass', 'reportCon@stdInactive');
		});

		Route::post('/profile', 'MainCon@profile');
		
		Route::post('/loginAttempt', 'MainCon@loginAttempt');
		Route::get('/loginCheck', 'MainCon@checkAdmin');
		Route::post('/logout', 'MainCon@logout');
		
	});
	
	Route::get('test', function(){
		echo bcrypt('admin');
	});

	Route::get('{path?}', 'MainCon@index')->where('path','.+');


});
