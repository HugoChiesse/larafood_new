<?php

use Illuminate\Support\Facades\Auth;
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

route::prefix('admin')->namespace('Admin')->middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::any('plans/search', 'PlanController@search')->name('plans.search');
    Route::resource('plans', 'PlanController');

    Route::any('profiles/search', 'ProfileController@search')->name('profiles.search');
    Route::resource('profiles', 'ProfileController');

    Route::any('permissions/search', 'PermissionController@search')->name('permissions.search');
    Route::resource('permissions', 'PermissionController');

    /**
     * PLAN X PROFILE
     */
    Route::get('plans/{idPlan}/profiles', 'ACL\PlanProfileController@profiles')->name('plans.profiles');
    Route::any('plans/{idPlan}/profiles/create', 'ACL\PlanProfileController@createProfile')->name('plans.createProfile');
    Route::post('plans/{idPlan}/profiles/store', 'ACL\PlanProfileController@storeProfile')->name('plans.storeProfile');
    Route::get('plans/{idPlan}/profiles/{idProfile}/remove', 'ACL\PlanProfileController@removeProfile')->name('plans.removeProfile');

    /**
     * PROFILE X PLAN
     */
    Route::get('profiles/{idProfile}/plans', 'ACL\ProfilePlanController@plans')->name('profiles.plans');

    /**
     * PROFILE X PERMISSION
     */
    Route::get('profiles/{idProfile}/permissions', 'ACL\ProfilePermissionController@permissions')->name('profiles.permissions');
    Route::any('profiles/{idProfile}/permissions/create', 'ACL\ProfilePermissionController@createPermission')->name('profiles.createPermission');
    Route::post('profiles/{idProfile}/permissions/store', 'ACL\ProfilePermissionController@storePermission')->name('profiles.storePermission');
    Route::get('profiles/{idProfile}/permissions/{idPermission}/remove', 'ACL\ProfilePermissionController@removePermission')->name('profiles.removePermission');

    /**
     * PERMISSION X PROFILE
     */
    Route::get('permissions/{idPermission}/profiles', 'ACL\PermissionProfileController@profile')->name('permissions.profiles');
});

Auth::routes();
