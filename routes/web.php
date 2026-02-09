<?php

use App\Http\Controllers\DisposisiMasukController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\AuthController;

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
Route::get('/dashboard', function () {
    return view('dashboard.index');
});
    
})->name('dashboard');
Route::middleware(['role:direktur,tu'])->group(function(){
Route::get('/inputsurat', function () {
    return view('dashboard.inputsurat');
    
})->name('inputsurat');


Route::get('/suratmasuk', [SuratMasukController::class, 'index'])->name('suratmasuk');

Route::post('/simpansurat', [SuratMasukController::class, 'store'])->name('simpansurat');
});

Route::post('/simpandisposisi', [DisposisiMasukController::class, 'store'])->name('simpandisposisi');
});
Route::get('/disposisimasuk', [DisposisiMasukController::class, 'index'])->name('disposisimasuk');