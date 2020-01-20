<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    echo('Base Prepared with announces!!!');
});

Route::group(['namespace'=>'School','prefix'=>'school'], function (){
    Route::resource('teacher','TeacherController')->names('school.teacher');
});
