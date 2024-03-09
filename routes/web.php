<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/1', function () {
//     return view('message');
// });


// <--- User Authentication Routes --->
Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'authLogin']);
Route::get('logout', [AuthController::class, 'authLogout']);


// <--- Admin Middleware Group -->
Route::group(['middleware' => 'admin'], function(){
    Route::get('admin/dashboard', [DashboardController::class, 'index']);
    Route::get('admin/admin/list', [AdminController::class, 'index']);
    Route::get('admin/admin/add', [AdminController::class, 'create']);
    Route::post('admin/admin/add', [AdminController::class, 'store']);
    Route::get('admin/admin/{id}/view', [AdminController::class, 'show']);
    Route::get('admin/admin/{id}/edit', [AdminController::class, 'edit']);
    Route::post('admin/admin/{id}/edit', [AdminController::class, 'update']);
    Route::get('admin/admin/{id}/delete', [AdminController::class, 'destroy']);
    

    // Profile tab
    Route::get('admin/profile', [UserController::class, 'showProfile']);
    Route::get('admin/change_password', [UserController::class, 'show_change_password']);
    Route::post('admin/change_password', [UserController::class, 'update_change_password']);
    Route::get('admin/change_prof_pic', [UserController::class, 'show_change_prof_pic']);
    Route::post('admin/change_prof_pic', [UserController::class, 'update_change_prof_pic']);

    




});



// <--- Manager Middleware Group -->
Route::group(['middleware' => 'manager'], function(){
    Route::get('manager/dashboard', [DashboardController::class, 'index']);


    // Profile tab
    Route::get('manager/profile', [UserController::class, 'showProfile']);
    Route::get('manager/change_password', [UserController::class, 'show_change_password']);
    Route::post('manager/change_password', [UserController::class, 'update_change_password']);
    Route::get('manager/change_prof_pic', [UserController::class, 'show_change_prof_pic']);
    Route::post('manager/change_prof_pic', [UserController::class, 'update_change_prof_pic']);
    
});




// <--- Office Staff  Middleware Group -->
Route::group(['middleware' => 'officeStaff'], function(){
    Route::get('officeStaff/dashboard', [DashboardController::class, 'index']);


    // Profile tab
    Route::get('officeStaff/profile', [UserController::class, 'showProfile']);
    Route::get('officeStaff/change_password', [UserController::class, 'show_change_password']);
    Route::post('officeStaff/change_password', [UserController::class, 'update_change_password']);
    Route::get('officeStaff/change_prof_pic', [UserController::class, 'show_change_prof_pic']);
    Route::post('officeStaff/change_prof_pic', [UserController::class, 'update_change_prof_pic']);
    
});




// <--- Medical Staff Middleware Group -->
Route::group(['middleware' => 'medicalStaff'], function(){
    Route::get('medicalStaff/dashboard', [DashboardController::class, 'index']);


    // Profile tab
    Route::get('medicalStaff/profile', [UserController::class, 'showProfile']);
    Route::get('medicalStaff/change_password', [UserController::class, 'show_change_password']);
    Route::post('medicalStaff/change_password', [UserController::class, 'update_change_password']);
    Route::get('medicalStaff/change_prof_pic', [UserController::class, 'show_change_prof_pic']);
    Route::post('medicalStaff/change_prof_pic', [UserController::class, 'update_change_prof_pic']);
    
});




// <--- Field Staff  Middleware Group -->
Route::group(['middleware' => 'fieldStaff'], function(){
    Route::get('fieldStaff/dashboard', [DashboardController::class, 'index']);


    // Profile tab
    Route::get('fieldStaff/profile', [UserController::class, 'showProfile']);
    Route::get('fieldStaff/change_password', [UserController::class, 'show_change_password']);
    Route::post('fieldStaff/change_password', [UserController::class, 'update_change_password']);
    Route::get('fieldStaff/change_prof_pic', [UserController::class, 'show_change_prof_pic']);
    Route::post('fieldStaff/change_prof_pic', [UserController::class, 'update_change_prof_pic']);
    
});




// <--- Stores Staff Middleware Group -->
Route::group(['middleware' => 'storesStaff'], function(){
    Route::get('storesStaff/dashboard', [DashboardController::class, 'index']);


    // Profile tab
    Route::get('storesStaff/profile', [UserController::class, 'showProfile']);
    Route::get('storesStaff/change_password', [UserController::class, 'show_change_password']);
    Route::post('storesStaff/change_password', [UserController::class, 'update_change_password']);
    Route::get('storesStaff/change_prof_pic', [UserController::class, 'show_change_prof_pic']);
    Route::post('storesStaff/change_prof_pic', [UserController::class, 'update_change_prof_pic']);
    
});