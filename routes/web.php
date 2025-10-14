<?php

use App\Http\Controllers\MachanicController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;


Route::get('/', [MachanicController::class, 'index']);
Route::get('/get-student', [StudentController::class, 'index'])->name('add.student');
Route::get('/add-student', [StudentController::class, 'add'])->name('add.student');
Route::post('/add-student', [StudentController::class, 'store'])->name('store.student');

