<?php

use App\Http\Controllers\Admin\AgamaController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PekerjaanController;
use App\Http\Controllers\Admin\PendidikanController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PostTagController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RtController;
use App\Http\Controllers\Admin\RwController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SocmedController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[DashboardController::class,'index'])->name('dashboard');
Route::get('/profile',[ProfileController::class,'index'])->name('profile.index');
Route::post('/profile',[ProfileController::class,'update'])->name('profile.update');
Route::get('/change-password',[ChangePasswordController::class,'index'])->name('change-password.index');
Route::post('/change-password',[ChangePasswordController::class,'update'])->name('change-password.update');

// users
Route::get('users/data',[UserController::class,'data'])->name('users.data');
Route::resource('users',UserController::class)->except('show');
Route::post('users/change-status',[UserController::class,'changeStatus'])->name('users.change-status');


// roles
Route::get('roles/data',[RoleController::class,'data'])->name('roles.data');
Route::post('roles/get',[RoleController::class,'get'])->name('roles.get');
Route::DELETE('roles/remove-permission',[RoleController::class,'removePermission'])->name('roles.remove-permission');
Route::post('roles/add-permission',[RoleController::class,'addPermission'])->name('roles.add-permission');
Route::resource('roles',RoleController::class)->except('create','show','edit','update');

// permissions
Route::get('permissions/data',[PermissionController::class,'data'])->name('permissions.data');
Route::post('permissions/get',[PermissionController::class,'get'])->name('permissions.get');
Route::post('permissions/getByRole',[PermissionController::class,'getByRole'])->name('permissions.getByRole');
Route::resource('permissions',PermissionController::class)->except('create','show','edit','update');


// RW
Route::get('rw/data',[RwController::class,'data'])->name('rw.data');
Route::post('rw/get',[RwController::class,'get'])->name('rw.get');
Route::resource('rw',RwController::class)->except('create','show','edit','update');

// RT
Route::get('rt/data',[RtController::class,'data'])->name('rt.data');
Route::resource('rt',RtController::class)->except('create','show','edit','update');

// Agama
Route::get('agama/data',[AgamaController::class,'data'])->name('agama.data');
Route::resource('agama',AgamaController::class)->except('create','show','edit','update');

// Pendidikan
Route::get('pendidikan/data',[PendidikanController::class,'data'])->name('pendidikan.data');
Route::resource('pendidikan',PendidikanController::class)->except('create','show','edit','update');

// pekerjaan
Route::get('pekerjaan/data',[PekerjaanController::class,'data'])->name('pekerjaan.data');
Route::resource('pekerjaan',PekerjaanController::class)->except('create','show','edit','update');


// setting
Route::get('setting',[SettingController::class,'index'])->name('settings.index');

Route::post('setting',[SettingController::class,'update'])->name('settings.update');
