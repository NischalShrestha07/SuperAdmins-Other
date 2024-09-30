<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\SuperAdminAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'superadmin'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', [SuperAdminController::class, 'index'])->name('superadmin.login');
        // Route::get('home', [SuperAdminController::class, 'register'])->name('admin.register');
        Route::post('login', [SuperAdminController::class, 'authenticate'])->name('superadmin.authenticate');
    });


    Route::group(['middleware' => SuperAdminAuth::class], function () {
        Route::get('logout', [SuperAdminController::class, 'logout'])->name('superadmin.logout');
        Route::get('/table', [SuperAdminController::class, 'table'])->name('superadmin.table');
        Route::get('/form', [SuperAdminController::class, 'form'])->name('superadmin.form');
        Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
    });
    // Route::group(['middleware' => 'superadmin.auth'], function () {
    //     Route::get('logout', [SuperAdminController::class, 'logout'])->name('superadmin.logout');
    //     Route::get('/table', [SuperAdminController::class, 'table'])->name('superadmin.table');
    //     Route::get('/form', [SuperAdminController::class, 'form'])->name('superadmin.form');
    //     Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
    // });
});





//SuperAdmin
Route::get('/addNewSuper/create', [SuperAdminController::class, 'home'])->name('superadmin.addSuper');
Route::post('/AddNewSuper', [SuperAdminController::class, 'AddNewSuper']);
Route::put('/UpdateSuper', [SuperAdminController::class, 'UpdateSuper']);
Route::delete('/DeleteSuperAdmin/{id}', [SuperAdminController::class, 'destroy'])->name('superadmin.destroy');



//Admin
Route::get('/addNewAdmin/create', [AdminController::class, 'index'])->name('admin.addAdmin');
Route::post('/AddNewAdmin', [AdminController::class, 'AddNewAdmin']);
Route::put('/UpdateAdmin', [AdminController::class, 'UpdateSuper']);
Route::delete('/DeleteAdmin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');


//Staff
Route::get('/addNewStaff/create', [StaffController::class, 'index'])->name('staff.addStaff');
Route::post('/AddNewStaff', [StaffController::class, 'AddNewStaff']);
Route::put('/UpdateStaff', [StaffController::class, 'UpdateStaff']);
Route::delete('/DeleteStaff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');
