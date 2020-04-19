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
Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();
Route::group(['middleware'=>'auth'],function(){
    Route::get('/home', 'HomeController@index')->name('home');
    //    user routes
    Route::group(['prefix' => 'users'],function(){
        Route::get('/','UserController@index')->name('user.index');
        Route::get('/create','UserController@create')->name('user.create');
        Route::post('/store','UserController@store')->name('user.store');
        Route::get('/{id}/show','UserController@show')->name('user.show');
        Route::get('/{id}/edit','UserController@edit')->name('user.edit');
        Route::post('/{id}/update','UserController@update')->name('user.update');
    });

    Route::get('/profile','UserController@profile')->name('user.profile');
    Route::post('/profile-update','UserController@profileUpdate')->name('user.profile.update');
//    Role routes
    Route::group(['prefix' => '/role'],function(){
        Route::get('/','RoleController@index')->name('role.index');
        Route::get('/create','RoleController@create')->name('role.create');
        Route::post('/store','RoleController@store')->name('role.store');
        Route::get('/{id}/edit','RoleController@edit')->name('role.edit');
        Route::post('/{id}/update','RoleController@update')->name('role.update');
    });
//    Permission routes
    Route::group(['prefix' => 'permission'],function (){
        Route::get('/','PermissionController@index')->name('permission.index');
        Route::post('/store','PermissionController@store')->name('permission.store');
        Route::post('/{id}/update','PermissionController@update')->name('permission.update');
    });
//    Permission routes
    Route::group(['prefix' => 'service'],function (){
        Route::get('/','ServiceController@index')->name('service.index');
        Route::post('/store','ServiceController@store')->name('service.store');
        Route::post('/{id}/update','ServiceController@update')->name('service.update');
    });
});
