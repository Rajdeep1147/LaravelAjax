<?php

use App\Http\Controllers\MachanicController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;


Route::get('/', [MachanicController::class, 'index']);
Route::get('/get-student', [StudentController::class, 'index'])->name('add.student');
Route::get('/add-student', [StudentController::class, 'add'])->name('add.student');
Route::post('/add-student', [StudentController::class, 'store'])->name('store.student');
Route::get('/edit-student/{id}', [StudentController::class, 'edit'])->name('edit.student');
Route::put('/edit-student/{id}', [StudentController::class, 'update'])->name('update.student');

