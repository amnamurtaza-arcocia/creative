<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::prefix('admin')->group(function () {
    Route::prefix('company')->group(function () {
        Route::get('/','App\Http\Controllers\Admin\CompanyController@index');
        Route::get('/create','App\Http\Controllers\Admin\CompanyController@create');
        Route::get('/edit/{id}','App\Http\Controllers\Admin\CompanyController@edit');
        Route::put('/update/{id}','App\Http\Controllers\Admin\CompanyController@update');
        Route::get('/delete/{id}','App\Http\Controllers\Admin\CompanyController@delete');
    });
    Route::prefix('employee')->group(function () {
        Route::get('/','App\Http\Controllers\Admin\EmployeeController@index');
        Route::post('/store','App\Http\Controllers\Admin\EmployeeController@store');
        Route::get('/create','App\Http\Controllers\Admin\EmployeeController@create');
        Route::get('/edit/{id}','App\Http\Controllers\Admin\EmployeeController@edit');
        Route::put('/update/{id}','App\Http\Controllers\Admin\EmployeeController@update');
        Route::get('/delete/{id}','App\Http\Controllers\Admin\EmployeeController@delete');
    });
});
Route::post('/store','App\Http\Controllers\Admin\CompanyController@store')->name('company.store');
Auth::routes();


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
