<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;

//login
Route::get('/', function() {return redirect('/login');});
Route::get('/login', function () {return view('login');})->name('login');

//admin here
Route::post('/login', [adminController::class, 'login'])->name('login.admin');
Route::get('/logout', [adminController::class, 'logout'])->name('logout.admin');
Route::get('/register', [adminController::class, 'registerIndex'])->name('registerIndex');
Route::post('/register', [adminController::class, 'register'])->name('registerTenant');
