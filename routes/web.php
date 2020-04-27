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
    return view('welcome');
})->middleware('auth');
Route::post('/', function () {
    return view('welcome');
})->middleware('auth');
Route::get('hello','HelloController@index');
Route::post('hello','HelloController@post');
Route::get('user','UserController@index');
Route::get('schedule', 'ScheduleController@index')->middleware('auth');
Route::post('schedule', 'ScheduleController@index')->middleware('auth');
// Route::get('schedule/{id}', 'ScheduleController@create');
// Route::post('schedule/{id}', 'ScheduleController@create');
Route::match(['get', 'post'],'schedule/create', 'ScheduleController@create');
Route::match(['get', 'post'],'schedule/insert', 'ScheduleController@insert');
Route::match(['get', 'post'],'schedule/change', 'ScheduleController@change');
Route::match(['get', 'post'],'schedule/delete', 'ScheduleController@delete');
Route::match(['get', 'post'],'schedule/outputcsv', 'ScheduleController@outputcsv');
// Route::match(['get', 'post'],'schedule/sample', 'ScheduleController@sample');
Route::match(['get', 'post'],'ajaxreturnanalyst/ajax_sample', 'AjaxReturnAnalystController@ajax_sample');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
