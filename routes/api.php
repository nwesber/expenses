<?php

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

Route::get('dashboard', 'DashboardController@index')->name('dashboard');

Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register')->name('auth.register');
    Route::post('login', 'AuthController@login')->name('auth.login');
    Route::get('refresh', 'AuthController@refresh')->name('auth.refresh.token');
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user')->name('auth.user');
        Route::post('logout', 'AuthController@logout')->name('auth.logout');
    });
});

Route::group(['middleware' => 'auth:api'], function(){
    // Users
    Route::get('users', 'UserController@index')->middleware('isAdmin');
    Route::get('users/{id}', 'UserController@show')->middleware('isAdminOrSelf');
    Route::post('users','UserController@store')->middleware('isAdmin');
    Route::put('users','UserController@update')->middleware('isAdmin');
    Route::delete('users', 'UserController@destroy')->middleware('isAdmin');

    // Roles
    Route::get('roles', 'RoleController@index')->middleware('isAdmin');
    Route::post('roles', 'RoleController@store')->middleware('isAdmin');
    Route::put('roles', 'RoleController@update')->middleware('isAdmin');
    Route::delete('roles', 'RoleController@destroy')->middleware('isAdmin');

    //Expense Categories
    Route::get('categories', 'ExpenseCategoryController@index')->middleware('isAdminOrSelf');
    Route::post('categories', 'ExpenseCategoryController@store')->middleware('isAdmin');
    Route::put('categories', 'ExpenseCategoryController@update')->middleware('isAdmin');
    Route::delete('categories', 'ExpenseCategoryController@destroy')->middleware('isAdmin');

    //Expenses
    Route::get('expenses', 'ExpensesController@index')->middleware('isAdminOrSelf');
    Route::post('expenses', 'ExpensesController@store')->middleware('isAdminOrSelf');
    Route::put('expenses', 'ExpensesController@update')->middleware('isAdminOrSelf');
    Route::delete('expenses', 'ExpensesController@destroy')->middleware('isAdminOrSelf');
});
