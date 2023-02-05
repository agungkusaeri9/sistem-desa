<?php

use App\Http\Controllers\Admin\AgamaController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PekerjaanController;
use App\Http\Controllers\Admin\PendidikanController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RtController;
use App\Http\Controllers\Admin\RwController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BantuanSosialController;
use App\Http\Controllers\Admin\KartuKeluargaController;
use App\Http\Controllers\Admin\WargaController;
use App\Http\Controllers\Admin\WargaKematianController;
use App\Http\Controllers\Admin\WargaPindahanController;
use App\Models\WargaKematian;
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
Route::post('rt/get',[RtController::class,'get'])->name('rt.get');
Route::resource('rt',RtController::class)->except('create','show','edit','update');

// Agama
Route::get('agama/data',[AgamaController::class,'data'])->name('agama.data');
Route::post('agama/get',[AgamaController::class,'get'])->name('agama.get');
Route::resource('agama',AgamaController::class)->except('create','show','edit','update');

// Pendidikan
Route::get('pendidikan/data',[PendidikanController::class,'data'])->name('pendidikan.data');
Route::post('pendidikan/get',[PendidikanController::class,'get'])->name('pendidikan.get');
Route::resource('pendidikan',PendidikanController::class)->except('create','show','edit','update');

// pekerjaan
Route::get('pekerjaan/data',[PekerjaanController::class,'data'])->name('pekerjaan.data');
Route::post('pekerjaan/get',[PekerjaanController::class,'get'])->name('pekerjaan.get');
Route::resource('pekerjaan',PekerjaanController::class)->except('create','show','edit','update');

// bantuan sosial
Route::get('bantuan-sosial/data',[BantuanSosialController::class,'data'])->name('bantuan-sosial.data');
Route::resource('bantuan-sosial',BantuanSosialController::class)->except('create','show','edit','update');



// warga
Route::get('warga/data',[WargaController::class,'data'])->name('warga.data');
Route::post('warga/get',[WargaController::class,'get'])->name('warga.get');
Route::post('warga/import',[WargaController::class,'import'])->name('warga.import');
Route::post('warga/getby',[WargaController::class,'get_by'])->name('warga.get-by');
Route::post('warga/detail',[WargaController::class,'show'])->name('warga.getById');
Route::resource('warga',WargaController::class)->except('create','show','edit','update');

// kartu keluarga
Route::get('kartu-keluarga/data',[KartuKeluargaController::class,'data'])->name('kartu-keluarga.data');

// anggota keluarga
Route::get('kartu-keluarga/tambah_anggota/{no_kk}',[KartuKeluargaController::class,'tambah_anggota'])->name('kartu-keluarga.tambah-anggota');
Route::post('kartu-keluarga/tambah_anggota/{no_kk}',[KartuKeluargaController::class,'proses_tambah_anggota'])->name('kartu-keluarga.proses-tambah-anggota');
Route::post('kartu-keluarga/set-kepala-keluarga/{no_kk}',[KartuKeluargaController::class,'set_kepala_keluarga'])->name('kartu-keluarga.set-kepala-keluarga');

Route::post('kartu-keluarga/get_anggota',[KartuKeluargaController::class,'get_anggota'])->name('kartu-keluarga.get-anggota');
Route::post('kartu-keluarga/hapus_anggota',[KartuKeluargaController::class,'hapus_anggota'])->name('kartu-keluarga.hapus-anggota');
Route::post('kartu-keluarga/detail',[KartuKeluargaController::class,'detail'])->name('kartu-keluarga.getById');
Route::resource('kartu-keluarga',KartuKeluargaController::class)->except('create','edit','update');

// warga kematian
Route::get('warga-kematian/data',[WargaKematianController::class,'data'])->name('warga-kematian.data');
Route::resource('warga-kematian',WargaKematianController::class)->except('create','show','edit','update');


// warga pindahan
Route::get('warga-pindahan/data',[WargaPindahanController::class,'data'])->name('warga-pindahan.data');
Route::post('warga-pindahan/detail',[WargaPindahanController::class,'show'])->name('warga-pindahan.getById');
Route::resource('warga-pindahan',WargaPindahanController::class)->except('create','show','edit','update');

// setting
Route::get('setting',[SettingController::class,'index'])->name('settings.index');

Route::post('setting',[SettingController::class,'update'])->name('settings.update');
