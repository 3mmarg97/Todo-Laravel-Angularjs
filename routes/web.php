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

Route::get('/{locale?}', 'TasksCtrl@view')->where('locale', '[a-zA-Z]{2}');

Route::get('api/', 'TasksCtrl@getTasks');

Route::Post('api/', 'TasksCtrl@addTask');

Route::Post('api/{id}/{state}', 'TasksCtrl@updateState');

Route::Post('api/edit/{id}/{name}', 'TasksCtrl@updateName');

Route::delete('api/', 'TasksCtrl@delete');