<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'vk', 'prefix' => 'vk'], function () {
    Route::post('/', 'VkApiController@postRequest');
});
Route::group(['namespace' => 'Api', 'prefix' => '/student'], function () {
    Route::get('/student', 'School\ApiStudentController@getStudentByTicketId');
    Route::get('/lessonAnnounces', 'School\ApiAnnouncesController@lessonAnnounces');
    Route::get('/eventAnnounces', 'School\ApiAnnouncesController@eventAnnounces');
});

Route::post('/teacher/getToken', 'Api\School\ApiTeacherAuthController@getToken');
Route::group(['namespace' => 'Api', 'prefix' => '/teacher', 'middleware' => 'APIToken'], function () {
    Route::get('/allStudents', 'School\ApiTeacherController@getAllStudents');
    Route::get('/initData', 'School\ApiTeacherController@getInitData');
    Route::post('/registerLesson', 'School\ApiTeacherController@registerLesson');
    Route::post('/updateLesson', 'School\ApiTeacherController@updateLesson');
    Route::post('/deleteLesson', 'School\ApiTeacherController@deleteLesson');
    Route::post('/registerTicket', 'School\ApiTeacherController@registerTicket');
    Route::post('/deleteTicket', 'School\ApiTeacherController@deleteTicket');
    Route::post('/getAllLessons', 'School\ApiTeacherController@getAllLessons');
    Route::post('/getAllTickets', 'School\ApiTeacherController@getAllTickets');
});

Route::get('deploy', function () {
    Artisan::call('git:deploy');
    exit("deployed");
});
