<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/taskslist/{q?}', 'TasksController@index');
Route::post('/taskslist', 'TasksController@store');
Route::get('/task/edit/{id}', 'TasksController@edit');
Route::patch('/task/edit/{id}', 'TasksController@update');
Route::delete('/task/{id}', 'TasksController@destroy');
