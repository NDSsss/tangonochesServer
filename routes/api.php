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

    Route::post('/initData', 'School\ApiTeacherController@getInitData');

    Route::post('/allStudents', 'School\ApiTeacherStudentsController@getAllStudents');
    Route::post('/studentById', 'School\ApiTeacherStudentsController@studentById');
    Route::post('/registerStudent', 'School\ApiTeacherStudentsController@registerStudent');
    Route::post('/updateStudent', 'School\ApiTeacherStudentsController@updateStudent');
    Route::post('/deleteStudent', 'School\ApiTeacherStudentsController@deleteStudent');

    Route::post('/allLessons', 'School\ApiTeacherLessonsController@allLessons');
    Route::post('/lessonById', 'School\ApiTeacherLessonsController@lessonById');
    Route::post('/registerLesson', 'School\ApiTeacherLessonsController@registerLesson');
    Route::post('/updateLesson', 'School\ApiTeacherLessonsController@updateLesson');
    Route::post('/deleteLesson', 'School\ApiTeacherLessonsController@deleteLesson');

    Route::post('/allTickets', 'School\ApiTeacherTicketsController@getAllTickets');
    Route::post('/ticketById', 'School\ApiTeacherTicketsController@ticketById');
    Route::post('/registerTicket', 'School\ApiTeacherTicketsController@registerTicket');
    Route::post('/deleteTicket', 'School\ApiTeacherTicketsController@deleteTicket');
});

Route::get('deploy', function () {
    Artisan::call('git:deploy');
    exit("deployed");
});
