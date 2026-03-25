<?php

use App\Http\Controllers\DisposisiMasukController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;

// Route::get('/login', function(){
//     return view('auth.login');
// });

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function (){
    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware(['role:direktur,tu'])->group(function(){
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::middleware(['role:direktur,tu'])->group(function(){
        Route::get('/inputsurat', function () {
            return view('dashboard.inputsurat');
            
        })->name('inputsurat');

        Route::get('/suratmasuk', [SuratMasukController::class, 'index'])->name('suratmasuk');

        Route::post('/simpansurat', [SuratMasukController::class, 'store'])->name('simpansurat');

        Route::get('/suratmasuk/{id}/edit', [SuratMasukController::class, 'edit'])->name('editsurat');

        Route::put('/suratmasuk/{id}', [SuratMasukController::class, 'update'])->name('updatesurat');

        Route::delete('/suratmasuk/{id}', [SuratMasukController::class, 'destroy'])->name('hapussurat');

        Route::post('/simpandisposisi', [DisposisiMasukController::class, 'store'])->name('simpandisposisi');
    });

    
});

Route::get('/disposisimasuk', [DisposisiMasukController::class, 'index'])->name('disposisimasuk');

Route::middleware(['auth','role:tu'])->group(function(){

    Route::get('/users', [UserController::class,'index'])->name('users.index');

    Route::get('/users/create', [UserController::class,'create'])->name('users.create');

    Route::post('/users', [UserController::class,'store'])->name('users.store');

    Route::get('/users/{id}/edit', [UserController::class,'edit'])->name('users.edit');

    Route::put('/users/{id}', [UserController::class,'update'])->name('users.update');

    Route::delete('/users/{id}', [UserController::class,'destroy'])->name('users.destroy');

});

Route::middleware(['auth', 'role:tu'])->group(function(){
    Route::resource('instansi', InstansiController::class);
});

Route::middleware(['auth', 'role:tu'])->group(function(){
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    Route::delete('/settings/{setting}', [SettingController::class, 'destroy'])->name('settings.destroy');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});