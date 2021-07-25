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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('form','ProjectController@create')->name('project.form');
Route::post('form/submit','ProjectController@submit')->name('project.form.submit');
Route::get('project/table','ProjectController@getTable')->name('project.index');
Route::get('project/edit/form/{id}','ProjectController@editForm')->name('project.edit');
Route::put('project/update/form/{id}','ProjectController@updateForm')->name('project.update');
Route::get('project/delete/form/{id}','ProjectController@destroy')->name('project.destroy');

Route::get('create','TaskController@getForm')->name('task.create');
Route::post('create/submit','TaskController@submitForm')->name('task.form.submit');
Route::get('create/table','TaskController@index')->name('task.table');
Route::get('create/edit/form/{id}','TaskController@edit')->name('task.edit');
Route::put('create/update/form/{id}','TaskController@update')->name('task.update');