<?php

use App\Http\Controllers\CompaniesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::resource('companies', CompaniesController::class);
    Route::get('setpassword', [\App\Http\Controllers\SetPasswordController::class, 'create'])->name('setpassword');
    Route::post('setpassword', [\App\Http\Controllers\SetPasswordController::class, 'store'])->name('setpassword.store');
});

Route::get('invitation/{user}', [App\Http\Controllers\CompaniesController::class, 'invitation'])->name('invitation');
