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

route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::any('plans/search', 'PlanController@search')->name('plans.search');
    Route::resource('plans', 'PlanController');

    Route::any('profiles/search', 'ProfileController@search')->name('profiles.search');
    Route::resource('profiles', 'ProfileController');

    Route::any('permissions/search', 'PermissionController@search')->name('permissions.search');
    Route::resource('permissions', 'PermissionController');

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
