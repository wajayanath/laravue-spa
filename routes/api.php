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


Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user', 'UserController@user'); //Auth user
    Route::apiResource('users','UserController');
    Route::apiResource('roles' , 'RoleController');
    Route::apiResource('customers' , 'CustomerController');
});

Route::post('import-csv', 'ImportController@import')->name('import.csv');
