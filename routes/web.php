<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ZonasController;
use App\Http\Controllers\FamiliasController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::controller(ZonasController::class)->group(function () {
    Route::get('zonas', 'index')->name('zonas.index');
    Route::get('zonas/create', 'create')->name('zonas.create');
    Route::post('zonas', 'store')->name('zonas.store');
    Route::get('zonas/{zona}', 'show')->name('zonas.show');

    Route::get('zonas/{zona}/edit', 'edit')->name('zonas.edit');
    Route::put('zonas/{zona}', 'update')->name('zonas.update');
    Route::delete('zonas/{zona}/destroy', 'destroy')->name('zonas.destroy');
});

Route::controller(FamiliasController::class)->group(function () {
    Route::get('familias', 'index')->name('familias.index');
    Route::get('familias/create', 'create')->name('familias.create');
    Route::post('familias', 'store')->name('familias.store');
    Route::get('familias/{familia}', 'show')->name('familias.show');

    Route::get('familias/{familia}/edit', 'edit')->name('familias.edit');
    Route::put('familias/{familia}', 'update')->name('familias.update');
    Route::delete('familias/{familia}/destroy', 'destroy')->name('familias.destroy');
});