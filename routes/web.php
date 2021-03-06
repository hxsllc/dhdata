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

Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/records', [\App\Http\Controllers\RecordController::class, 'index'])->name('records.index');
    Route::get('/records/create', [\App\Http\Controllers\RecordController::class, 'create'])->name('records.create');
    Route::post('/records', [\App\Http\Controllers\RecordController::class, 'store'])->name('records.store');
    Route::get('/records/{record}/edit', [\App\Http\Controllers\RecordController::class, 'edit'])->name('records.edit');
    Route::put('/records/{record}', [\App\Http\Controllers\RecordController::class, 'update'])->name('records.update');
    Route::get('/records/{record}/push', [\App\Http\Controllers\RecordController::class, 'pushToQueue'])->name('records.push');

    Route::get('/web-queue', [\App\Http\Controllers\WebQueueController::class, 'index'])->name('queue.index');
    Route::get('/web-queue/{record}/edit', [\App\Http\Controllers\WebQueueController::class, 'edit'])->name('queue.edit');
    Route::put('/web-queue/{record}', [\App\Http\Controllers\WebQueueController::class, 'update'])->name('queue.update');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->group(function() {
    Route::resource('/users', \App\Http\Controllers\UserController::class);
});
