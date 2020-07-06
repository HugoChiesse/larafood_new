<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->namespace('Api')->group(function () {
    Route::get('tenants/{uuid}', 'TenantApiController@getUuid');
    Route::resource('tenants', 'TenantApiController');

    Route::get('category/{url}', 'CategoryApiController@show');
    Route::get('categories', 'CategoryApiController@getCategoriesByTenant');

    Route::get('tables', 'TableApiController@getTablesByTenant');

    Route::get('table/{identify}', 'TableApiController@show');
    Route::get('tables', 'TableApiController@getTablesByTenant');

    Route::get('products', 'ProductsApiController@productsByTenant');
    Route::get('products/{flag}', 'ProductsApiController@show');
});
