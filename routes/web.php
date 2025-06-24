<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\Auth\RegisteredUserController;
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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('/');


Route::middleware(['auth'])->group(function () {
    Route::resource('taches', TacheController::class)->parameters([
        'taches' => 'tache',
]);
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('users/create', [RegisteredUserController::class, 'create'])->name('users.create');
    Route::post('users', [RegisteredUserController::class, 'store'])->name('users.store');
});



require __DIR__.'/auth.php';
