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

    Route::any('users/search', 'UserController@search')->name('users.search');
    Route::resource('users', 'UserController');

    Route::any('categories/search', 'CategoryController@search')->name('categories.search');
    Route::resource('categories', 'CategoryController');

    Route::any('products/search', 'ProductController@search')->name('products.search');
    Route::resource('products', 'ProductController');
    
    Route::any('tables/search', 'TableController@search')->name('tables.search');
    Route::resource('tables', 'TableController');

    /**
     * PRODUCT X CATEGORY
     */
    Route::get('products/{idProduct}/categories', 'ACL\CategoryProductController@categories')->name('products.categories');
    Route::any('products/{idProduct}/categories/create', 'ACL\CategoryProductController@createCategory')->name('products.createCategory');
    Route::post('products/{idProduct}/categories/store', 'ACL\CategoryProductController@storeCategory')->name('products.storeCategory');
    Route::get('products/{idProduct}/categories/{idCategory}/remove', 'ACL\CategoryProductController@removeCategory')->name('products.removeCategory');

    /**
     * Details Plan
     */
    Route::get('plans/{idPlan}/details', 'DetailPlanController@index')->name('details.index');
    Route::get('plans/{idPlan}/details/create', 'DetailPlanController@create')->name('details.create');
    Route::post('plans/{idPlan}/details/store', 'DetailPlanController@store')->name('details.store');
    Route::get('plans/{idPlan}/details/{idDetail}/show', 'DetailPlanController@show')->name('details.show');
    Route::get('plans/{idPlan}/details/{idDetail}/edit', 'DetailPlanController@edit')->name('details.edit');
    Route::put('plans/{idPlan}/details/{idDetail}/update', 'DetailPlanController@update')->name('details.update');
    Route::delete('plans/{idPlan}/details/{idDetail}/destroy', 'DetailPlanController@destroy')->name('details.destroy');

    /**
     * PLAN X PROFILE
     */
    Route::get('plans/{idPlan}/categories', 'ACL\PlanProfileController@profiles')->name('plans.profiles');
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

Route::get('/', 'Site\HomeController@index')->name('home');
Route::get('/plan/{url}', 'Site\HomeController@plan')->name('home.subscription');
Auth::routes();
