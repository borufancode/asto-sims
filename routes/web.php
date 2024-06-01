<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;


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


Route::get('/',[StudentController::class,'liststudent'])->name('student-list');
Route::get('add-student',[StudentController::class, 'addstudent']);
Route::post('/savestudent',[StudentController::class, 'store'])->name('savestudent');
Route::get('/list',[StudentController::class,'liststudent'])->name('student.list');
Route::get('/edit/{id}',[StudentController::class,'edit'])->name('student.edit');
Route::put('/update/{id}',[StudentController::class,'update'])->name('student.update');
Route::delete('/delete/{id}',[StudentController::class,'destroy'])->name('student.delete');
