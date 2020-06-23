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

Route::get('admin', 'Admin\HomeController@index')->name('home');

Route::any('admin/plans/search', 'Admin\PlanController@search')->name('plans.search');
Route::resource('admin/plans', 'Admin\PlanController');