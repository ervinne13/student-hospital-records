<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your application. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */

Route::get('/', 'HomeController@index');

Route::auth();
Route::get('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth'], function () {

    Route::get('logs/datatable', 'LogsController@datatable');
    Route::get('logs', 'LogsController@index');

    Route::get('users/datatable', 'UsersController@datatable');
    Route::resource('users', 'UsersController');

    Route::get('students/datatable', 'StudentsController@datatable');
    Route::resource('students', 'StudentsController');

    Route::get('colleges/datatable', 'CollegesController@datatable');
    Route::resource('colleges', 'CollegesController');

    // <editor-fold defaultstate="collapsed" desc="Laboratory">

    Route::get('xray/datatable', 'XrayController@datatable');
    Route::resource('xray', 'XrayController');

    Route::get('hematology/datatable', 'HematologyController@datatable');
    Route::resource('hematology', 'HematologyController');

    Route::get('vital-signs/datatable', 'VitalSignsController@datatable');
    Route::resource('vital-signs', 'VitalSignsController');

    Route::get('pe/datatable', 'PhysicalExamController@datatable');
    Route::resource('pe', 'PhysicalExamController');

    Route::get('urinalysis/datatable', 'UrinalysisController@datatable');
    Route::resource('urinalysis', 'UrinalysisController');

    // </editor-fold>
});
