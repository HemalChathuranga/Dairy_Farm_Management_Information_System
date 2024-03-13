<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FieldStaffController;
use App\Http\Controllers\OfficeStaffController;
use App\Http\Controllers\StoresStaffController;
use App\Http\Controllers\MedicalStaffController;

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

Route::get('/1', function () {
    return view('message');
});


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
    

    //Manager Users CRUD in Admin
    Route::get('admin/manager/list', [ManagerController::class, 'index']);
    Route::get('admin/manager/add', [ManagerController::class, 'create']);
    Route::post('admin/manager/add', [ManagerController::class, 'store']);
    Route::get('admin/manager/{id}/view', [ManagerController::class, 'show']);
    Route::get('admin/manager/{id}/edit', [ManagerController::class, 'edit']);
    Route::post('admin/manager/{id}/edit', [ManagerController::class, 'update']);
    Route::get('admin/manager/{id}/delete', [ManagerController::class, 'destroy']);


    //Office Staff Users CRUD in Admin
    Route::get('admin/officeStaff/list', [OfficeStaffController::class, 'index']);
    Route::get('admin/officeStaff/add', [OfficeStaffController::class, 'create']);
    Route::post('admin/officeStaff/add', [OfficeStaffController::class, 'store']);
    Route::get('admin/officeStaff/{id}/view', [OfficeStaffController::class, 'show']);
    Route::get('admin/officeStaff/{id}/edit', [OfficeStaffController::class, 'edit']);
    Route::post('admin/officeStaff/{id}/edit', [OfficeStaffController::class, 'update']);
    Route::get('admin/officeStaff/{id}/delete', [OfficeStaffController::class, 'destroy']);


    //Medical Staff Users CRUD in Admin
    Route::get('admin/medicalStaff/list', [MedicalStaffController::class, 'index']);
    Route::get('admin/medicalStaff/add', [MedicalStaffController::class, 'create']);
    Route::post('admin/medicalStaff/add', [MedicalStaffController::class, 'store']);
    Route::get('admin/medicalStaff/{id}/view', [MedicalStaffController::class, 'show']);
    Route::get('admin/medicalStaff/{id}/edit', [MedicalStaffController::class, 'edit']);
    Route::post('admin/medicalStaff/{id}/edit', [MedicalStaffController::class, 'update']);
    Route::get('admin/medicalStaff/{id}/delete', [MedicalStaffController::class, 'destroy']);


    //Field Staff Users CRUD in Admin
    Route::get('admin/fieldStaff/list', [FieldStaffController::class, 'index']);
    Route::get('admin/fieldStaff/add', [FieldStaffController::class, 'create']);
    Route::post('admin/fieldStaff/add', [FieldStaffController::class, 'store']);
    Route::get('admin/fieldStaff/{id}/view', [FieldStaffController::class, 'show']);
    Route::get('admin/fieldStaff/{id}/edit', [FieldStaffController::class, 'edit']);
    Route::post('admin/fieldStaff/{id}/edit', [FieldStaffController::class, 'update']);
    Route::get('admin/fieldStaff/{id}/delete', [FieldStaffController::class, 'destroy']);


    //Stores Staff Users CRUD in Admin
    Route::get('admin/storesStaff/list', [StoresStaffController::class, 'index']);
    Route::get('admin/storesStaff/add', [StoresStaffController::class, 'create']);
    Route::post('admin/storesStaff/add', [StoresStaffController::class, 'store']);
    Route::get('admin/storesStaff/{id}/view', [StoresStaffController::class, 'show']);
    Route::get('admin/storesStaff/{id}/edit', [StoresStaffController::class, 'edit']);
    Route::post('admin/storesStaff/{id}/edit', [StoresStaffController::class, 'update']);
    Route::get('admin/storesStaff/{id}/delete', [StoresStaffController::class, 'destroy']);




});



// <--- Manager Middleware Group -->
Route::group(['middleware' => 'manager'], function(){
    Route::get('manager/dashboard', [DashboardController::class, 'index']);


    //Office Staff Users CRUD in Admin
    Route::get('manager/officeStaff/list', [OfficeStaffController::class, 'index']);
    Route::get('manager/officeStaff/add', [OfficeStaffController::class, 'create']);
    Route::post('manager/officeStaff/add', [OfficeStaffController::class, 'store']);
    Route::get('manager/officeStaff/{id}/view', [OfficeStaffController::class, 'show']);
    Route::get('manager/officeStaff/{id}/edit', [OfficeStaffController::class, 'edit']);
    Route::post('manager/officeStaff/{id}/edit', [OfficeStaffController::class, 'update']);


    //Medical Staff Users CRUD in Admin
    Route::get('manager/medicalStaff/list', [MedicalStaffController::class, 'index']);
    Route::get('manager/medicalStaff/add', [MedicalStaffController::class, 'create']);
    Route::post('manager/medicalStaff/add', [MedicalStaffController::class, 'store']);
    Route::get('manager/medicalStaff/{id}/view', [MedicalStaffController::class, 'show']);
    Route::get('manager/medicalStaff/{id}/edit', [MedicalStaffController::class, 'edit']);
    Route::post('manager/medicalStaff/{id}/edit', [MedicalStaffController::class, 'update']);


    //Field Staff Users CRUD in Admin
    Route::get('manager/fieldStaff/list', [FieldStaffController::class, 'index']);
    Route::get('manager/fieldStaff/add', [FieldStaffController::class, 'create']);
    Route::post('manager/fieldStaff/add', [FieldStaffController::class, 'store']);
    Route::get('manager/fieldStaff/{id}/view', [FieldStaffController::class, 'show']);
    Route::get('manager/fieldStaff/{id}/edit', [FieldStaffController::class, 'edit']);
    Route::post('manager/fieldStaff/{id}/edit', [FieldStaffController::class, 'update']);


    //Stores Staff Users CRUD in Admin
    Route::get('manager/storesStaff/list', [StoresStaffController::class, 'index']);
    Route::get('manager/storesStaff/add', [StoresStaffController::class, 'create']);
    Route::post('manager/storesStaff/add', [StoresStaffController::class, 'store']);
    Route::get('manager/storesStaff/{id}/view', [StoresStaffController::class, 'show']);
    Route::get('manager/storesStaff/{id}/edit', [StoresStaffController::class, 'edit']);
    Route::post('manager/storesStaff/{id}/edit', [StoresStaffController::class, 'update']);



    
    
});




// <--- Office Staff  Middleware Group -->
Route::group(['middleware' => 'officeStaff'], function(){
    Route::get('officeStaff/dashboard', [DashboardController::class, 'index']);


    
    
});




// <--- Medical Staff Middleware Group -->
Route::group(['middleware' => 'medicalStaff'], function(){
    Route::get('medicalStaff/dashboard', [DashboardController::class, 'index']);


    
    
});




// <--- Field Staff  Middleware Group -->
Route::group(['middleware' => 'fieldStaff'], function(){
    Route::get('fieldStaff/dashboard', [DashboardController::class, 'index']);


    
    
});




// <--- Stores Staff Middleware Group -->
Route::group(['middleware' => 'storesStaff'], function(){
    Route::get('storesStaff/dashboard', [DashboardController::class, 'index']);


    
    
});




//Middleware group for all users Profile tab feature
Route::group(['middleware' => 'user'], function(){
    Route::get('profile', [UserController::class, 'showProfile']);
    Route::get('change_password', [UserController::class, 'show_change_password']);
    Route::post('change_password', [UserController::class, 'update_change_password']);
    Route::get('change_prof_pic', [UserController::class, 'show_change_prof_pic']);
    Route::post('change_prof_pic', [UserController::class, 'update_change_prof_pic']);

});