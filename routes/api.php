<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

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
    Route::post('/login', 'School\ApiStudentController@login');
    Route::group(['prefix' => '/protected', 'middleware' => 'StudentToken'], function (){
        Route::post('/notification/{id}', 'School\ApiStudentController@getNotification');
        Route::get('/info', 'School\ApiStudentController@getStudentInfo');
    });
    Route::get('/student', 'School\ApiStudentController@getStudentByTicketId');
    Route::get('/studentInfo', 'School\ApiStudentController@getStudentInfoByTicketId');
    Route::get('/lessonAnnounces', 'School\ApiAnnouncesController@lessonAnnounces');
    Route::get('/eventAnnounces', 'School\ApiAnnouncesController@eventAnnounces');
});

Route::post('student/registerNew', 'Api\School\StudentRegisterController@registerStudent');

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

    Route::get('/allGroups', 'School\ApiTeacherGroupsController@getAllGroups');
    Route::get('/allTicketCountTypes', 'School\ApiTeacherTicketCountTypesController@getAllTicketCountTypes');
    Route::get('/allTicketEventTypes', 'School\ApiTeacherTicketEventTypesController@getAllTicketEventTypes');

    Route::get('allTeachers', 'School\ApiTeacherTeachersController@getAllTeachers');
});

Route::post('vkBot','VkController@vkEvent');

Route::get('deploy', function () {
    Artisan::call('git:deploy');
    exit("deployed");
});

Route::post('test', 'Api\Notifications\NotificationController@create');
