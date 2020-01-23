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
    return view('home');
});

Route::group(['namespace'=>'School','prefix'=>'school'], function (){
    Route::resource('teachers','TeacherController')->names('school.teachers');
});

Route::group(['namespace'=>'Admin\School','prefix'=>'admin/school'], function (){
    Route::resource('teachers','AdminSchoolTeachersController')->names('admin.school.teachers');
    Route::resource('students','AdminSchoolStudentsController')->names('admin.school.students');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
