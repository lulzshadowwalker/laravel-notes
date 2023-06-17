<?php

use App\Http\Controllers\NotesController;
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


Route::get('/', [NotesController::class, 'index'])->name('home');

Route::post('/addNote', [NotesController::class, 'add'])->name('addNote');

Route::post('/updateNote/{id}', [NotesController::class, 'update'])->name('updateNote');


Route::post('/removeNote/{id}', [NotesController::class, 'remove'])->name('remove');
