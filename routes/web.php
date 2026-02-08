<?php

use App\Http\Controllers\DisposisiMasukController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\SuratMasukController;

Route::get('/login', function(){
    return view('auth.login');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticate'])->name('login.post');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
    
})->name('dashboard');

Route::get('/inputsurat', function () {
    return view('dashboard.inputsurat');
    
})->name('inputsurat');

Route::get('/suratmasuk', [SuratMasukController::class, 'index'])->name('suratmasuk');
Route::post('/simpansurat', [SuratMasukController::class, 'store'])->name('simpansurat');
Route::get('/disposisimasuk', [DisposisiMasukController::class, 'index'])->name('disposisimasuk');
Route::post('/simpandisposisi', [DisposisiMasukController::class, 'store'])->name('simpandisposisi');