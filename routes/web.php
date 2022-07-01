<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoupaController;
use App\Models\Roupa;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [RoupaController::class, 'index']);
Route::post('/roupas', [RoupaController::class, 'store']);
Route::get('/roupas/create', [RoupaController::class, 'create'])->middleware('auth');
Route::get('/roupas/{id}', [RoupaController::class, 'show']);
Route::get('/dashboard', [RoupaController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::post('/roupas/wish/{id}', [RoupaController::class, 'wishRoupa'])->middleware('auth');
Route::get('/roupas/edit/{id}', [RoupaController::class, 'edit'])->middleware('auth');
Route::put('/roupas/update/{id}', [RoupaController::class, 'update'])->middleware('auth');
Route::delete('/roupas/{id}', [RoupaController::class, 'destroy'])->middleware('auth');
Route::delete('/roupas/leave/{id}', [RoupaController::class, 'leaveRoupa'])->middleware('auth');







