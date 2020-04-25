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
        Route::get('/request-list','UserController@userRequest')->name('user.request_list');
        Route::post('/request-list','UserController@userRequestStore')->name('user.request_list.store');
        Route::post('/request-list/{id}/update','UserController@userRequestUpdate')->name('user.request_list.update');
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
//    Service routes
    Route::group(['prefix' => 'service'],function (){
        Route::get('/','ServiceController@index')->name('service.index');
        Route::post('/store','ServiceController@store')->name('service.store');
        Route::post('/{id}/update','ServiceController@update')->name('service.update');
    });
//    Provider slot routes
    Route::group(['prefix' => 'slot'],function (){
        Route::get('/','SlotController@index')->name('slot.index');
        Route::post('/store','SlotController@store')->name('slot.store');
        Route::post('/{id}/update','SlotController@update')->name('slot.update');
    });
//    Category provide routes
    Route::group(['prefix' => 'category-provider'],function (){
        Route::get('/','CategoryProviderController@index')->name('category_provider.index');
        Route::post('/store','CategoryProviderController@store')->name('category_provider.store');
        Route::get('/request-list','CategoryProviderController@requestList')->name('category_provider.reqList');
        Route::post('/{id}/update','CategoryProviderController@update')->name('category_provider.update');
    });
//    Service Category routes
    Route::group(['prefix' => 'category'],function (){
        Route::get('/','CategoryController@index')->name('category.index');
        Route::post('/store','CategoryController@store')->name('category.store');
        Route::post('/{id}/update','CategoryController@update')->name('category.update');
    });
//    Appointment routes
    Route::group(['prefix' => 'appointment'],function (){
        Route::get('/','AppointmentController@index')->name('appointment.index');
//        Route::post('/store','AppointmentController@store')->name('appointment.store');
        Route::get('/{id}/view','AppointmentController@view')->name('appointment.view');
        Route::post('/{id}/update-log','AppointmentController@updateTimeLog')->name('appointment.time.log')->middleware('can:update appointment log');
        Route::post('/{id}/log-get','AppointmentController@getTimeLog')->name('appointment.time.log.get')->middleware('can:update appointment log');
    });
});
