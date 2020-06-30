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

    Route::get('/teste', function(){
        // dd(auth()->user()->permissions()); // ==> Verifica a permissão do plano
        // dd(auth()->user()->hasPermission('permissions')); // ==> Verifica a permissão do usuário
        // dd(auth()->user()->isAdmin()); // ==> Verifica se o e-mail cadastrado é um administrador
        // dd(auth()->user()->isTenant()); // ==> Verifica se o e-mail cadastrado não é um administrador
    });

    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('tenants', 'TenantController');

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
     * Plan x Profile
     */
    Route::get('plans/{id}/profile/{idProfile}/detach', 'ACL\PlanProfileController@detachProfilePlan')->name('plans.profile.detach');
    Route::post('plans/{id}/profiles', 'ACL\PlanProfileController@attachProfilesPlan')->name('plans.profiles.attach');
    Route::any('plans/{id}/profiles/create', 'ACL\PlanProfileController@profilesAvailable')->name('plans.profiles.available');
    Route::get('plans/{id}/profiles', 'ACL\PlanProfileController@profiles')->name('plans.profiles');
    Route::get('profiles/{id}/plans', 'ACL\PlanProfileController@plans')->name('profiles.plans');

    /**
     * Permission x Profile
     */
    Route::get('profiles/{id}/permission/{idPermission}/detach', 'ACL\PermissionProfileController@detachPermissionProfile')->name('profiles.permission.detach');
    Route::post('profiles/{id}/permissions', 'ACL\PermissionProfileController@attachPermissionsProfile')->name('profiles.permissions.attach');
    Route::any('profiles/{id}/permissions/create', 'ACL\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');
    Route::get('profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');
    Route::get('permissions/{id}/profile', 'ACL\PermissionProfileController@profiles')->name('permissions.profiles');
});

Route::get('/', 'Site\HomeController@index')->name('home');
Route::get('/plan/{url}', 'Site\HomeController@plan')->name('home.subscription');
Auth::routes();