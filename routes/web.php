<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/records', [\App\Http\Controllers\RecordController::class, 'index'])->name('records.index');
    Route::get('/records/{record}/edit', [\App\Http\Controllers\RecordController::class, 'edit'])->name('records.edit');
    Route::put('/records/{record}', [\App\Http\Controllers\RecordController::class, 'update'])->name('records.update');
    Route::get('/records/{record}/push', [\App\Http\Controllers\RecordController::class, 'push'])->name('records.push');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->group(function() {
    Route::resource('/users', \App\Http\Controllers\UserController::class);
});
