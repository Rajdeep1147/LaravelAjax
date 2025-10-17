<?php

use App\Http\Controllers\MachanicController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;


Route::get('/get-student', [StudentController::class, 'index'])->name('get-student');
Route::get('/students/list', [StudentController::class, 'getStudents'])->name('students.list');
Route::get('/add-student', [StudentController::class, 'add'])->name('add.student');
Route::post('/add-student', [StudentController::class, 'store'])->name('store.student');
Route::get('/edit-student/{id}', [StudentController::class, 'edit'])->name('edit.student');
Route::put('/edit-student/{id}', [StudentController::class, 'update'])->name('update.student');
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('delete.student');
Route::get('/student/{id}', [StudentController::class, 'show'])->name('show.student');

