<?php

use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;

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

Route::get('/create-resource', [ManagerController::class, 'create'])->name('create-resource');
Route::get('/delete-resource', [ManagerController::class, 'delete'])->name('delete-resource');
Route::get('/{error?}', [ManagerController::class, 'index'])->name('list-resource');
