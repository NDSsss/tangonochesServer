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

Route::get('/', 'School\StudentController@showAnnounces');
Route::get('/licence', function (){
    $appName = "Licence";
    return view('licence', compact('appName'));
});

Route::get('/licenceAndroid', function (){
    $appName = "Licence";
    return view('licence', compact('appName'));
});

Route::get('/admin', function () {
    return view('admin');
})->middleware(['auth'])->name('admin');

Route::group(['namespace' => 'School', 'prefix' => 'school'], function () {
    Route::resource('teachers', 'TeacherController')->names('school.teachers');
});

$adminSpace = config('global.admin_routes');
$adminNamespace = $adminSpace['namespace'];
$adminPrefix = $adminSpace['prefix'];
$adminGlobalGroups = $adminSpace['global_groups'];
foreach ($adminGlobalGroups as $globalGroupSpace) {
    $globalGroupNameSpace = $globalGroupSpace['group_namespace'];
    $globalGroupPrefix = $globalGroupSpace['group_prefix'];
    $globalGroupPages = $globalGroupSpace['pages'];
    Route::group(
        ['namespace' =>
            $adminNamespace . $globalGroupNameSpace,
            'prefix' =>
                $adminPrefix .'/'. $globalGroupPrefix]
        , function () use ($adminPrefix, $globalGroupPrefix, $globalGroupPages) {
        foreach ($globalGroupPages as $pageSpace) {
            $pageRoute = $pageSpace[0];
            $pageController = $pageSpace[1];
            Route::resource($pageRoute, $pageController)->names("$adminPrefix." . "$globalGroupPrefix." . $pageRoute);
        }
    });
}

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
