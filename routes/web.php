<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('dashboard/index');
// });

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');


Route::get('spk-select-bantuan', [App\Http\Controllers\SpkMautController::class, 'selectBantuan'])->name('spk-select-bantuan');
Route::get('spk-maut-add', [App\Http\Controllers\SpkMautController::class, 'kwb'])->name('spk-maut-add');
Route::post('spk-maut-checked-kwb', [App\Http\Controllers\SpkMautController::class, 'checkedKwb'])->name('spk-maut-checked-kwb');

Route::get('spk-maut-result', [App\Http\Controllers\SpkMautController::class, 'index'])->name('spk-maut-result');
Route::post('spk-maut-result-detail', [App\Http\Controllers\SpkMautController::class, 'resultDetail'])->name('spk-maut-result-detail');

Route::post('print-maut-result', [App\Http\Controllers\SpkMautController::class, 'print'])->name('print-maut-result');

Route::get('data-kwb', [App\Http\Controllers\KwbController::class, 'index'])->name('data-kwb');
Route::post('add-data-kwb', [App\Http\Controllers\KwbController::class, 'add'])->name('add-data-kwb');
Route::post('edit-data-kwb', [App\Http\Controllers\KwbController::class, 'edit'])->name('edit-data-kwb');
Route::post('delete-data-kwb', [App\Http\Controllers\KwbController::class, 'delete'])->name('delete-data-kwb');

Route::get('data-bantuan', [App\Http\Controllers\BantuanController::class, 'index'])->name('data-bantuan');
Route::post('add-data-bantuan', [App\Http\Controllers\BantuanController::class, 'add'])->name('add-data-bantuan');
Route::post('edit-data-bantuan', [App\Http\Controllers\BantuanController::class, 'edit'])->name('edit-data-bantuan');
Route::post('delete-data-bantuan', [App\Http\Controllers\BantuanController::class, 'delete'])->name('delete-data-bantuan');

Route::get('data-kriteria', [App\Http\Controllers\SpkMautController::class, 'indexCriteria'])->name('data-kriteria');
Route::post('data-kriteria-edit', [App\Http\Controllers\SpkMautController::class, 'editCriteria'])->name('data-kriteria-edit');

// Route::get('/spk-maut-add', [::class, 'lkhDetail'])->name('spk-maut-add');

Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'authenticate'])->name('login');