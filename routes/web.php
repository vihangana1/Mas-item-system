<?php

use Illuminate\Support\Facades\Route;



use \App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminLoginController;
use \App\Http\Controllers\DieselController;
use \App\Http\Controllers\UserDashboardController;
use \App\Http\Controllers\UserDieselController;

Route::get('/', [UserDashboardController::class, 'index'])->name('userdashboard');
Route::get('/user/dashboard', [UserDashboardController::class, 'index']);
Route::get('/adminLogin',[AdminloginController::class, 'adminLogin'])->name('adminlogin');
Route::get('/adminDashboard',[AdminDashboardController::class, 'adminDashboard'])->name('admindashboard');
Route::get('/category', function() { return "Category/Diesel Page"; })->name('category');
Route::get('/fuel', function() { return "Fuel Page"; })->name('fuel');

Route::get('/diesel',[DieselController::class, 'dieselPage'])->name('dieselPage');
Route::post('/diesel/save', [DieselController::class, 'store'])->name('diesel.save');
Route::put('/diesel/update/{id}', [DieselController::class, 'update'])->name('diesel.update');
Route::delete('/diesel/delete/{id}', [DieselController::class, 'destroy'])->name('diesel.delete');

Route::get('/user/diesel', [UserDieselController::class, 'index'])->name('userDieselPage');
Route::get('/user/diesel/refresh', [UserDieselController::class, 'refresh'])->name('userDiesel.refresh');
Route::get('/user/diesel/download', [UserDieselController::class, 'download'])->name('userDiesel.download');

