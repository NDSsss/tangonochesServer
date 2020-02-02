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

Route::group(['namespace'=>'vk','prefix'=>'vk'], function (){
   Route::post('/','VkApiController@postRequest');
});
Route::group(['namespace'=>'Api'], function (){
   Route::get('/student','School\ApiStudentController@getStudentByTicketId');
   Route::get('/lessonAnnounces','School\ApiAnnouncesController@lessonAnnounces');
   Route::get('/eventAnnounces','School\ApiAnnouncesController@eventAnnounces');
});

Route::get('deploy',function (){
   Artisan::call('git:deploy');
   exit("deployed");
});
