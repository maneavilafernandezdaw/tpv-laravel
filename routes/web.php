<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ZonasController;
use App\Http\Controllers\FamiliasController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ComandasController;
use App\Http\Controllers\ProductAjaxController;
use App\Http\Controllers\CobrosController;
use App\Http\Controllers\CajasController;
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

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

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
    Route::get('zonas/consultar/{zona}', 'consultar')->name('zonas.consultar');
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

Route::controller(ProductosController::class)->group(function () {
    Route::get('productos', 'index')->name('productos.index');
    Route::get('productos/create', 'create')->name('productos.create');
    Route::post('productos', 'store')->name('productos.store');
    Route::get('productos/{producto}', 'show')->name('productos.show');
    Route::post('productos/ajax', 'ajax')->name('productos.ajax');
    Route::put('productos/{producto}/edit', 'update')->name('productos.update');
    Route::delete('productos/{producto}/destroy', 'destroy')->name('productos.destroy');
});

Route::controller(ComandasController::class)->group(function () {
    Route::get('comandas', 'index')->name('comandas.index');
    Route::get('comandas/cuenta', 'cuenta')->name('comandas.cuenta');
    Route::get('comandas/create/{zona}/{mesa}', 'create')->name('comandas.create');
    Route::get('comandas/cuenta/{zona}/{mesa}', 'consultarCuenta')->name('comandas.consultarCuenta');
    Route::get('comandas/pedido/{zona}/{mesa}', 'pedido')->name('comandas.pedido');
    Route::post('comandas', 'store')->name('comandas.store');
    Route::post('comandas/incrementar', 'incrementar')->name('comandas.incrementar');
    Route::post('comandas/decrementar', 'decrementar')->name('comandas.decrementar');
    Route::post('comandas/incrementarTabla', 'incrementarTabla')->name('comandas.incrementarTabla');
    Route::post('comandas/decrementarTabla', 'decrementarTabla')->name('comandas.decrementarTabla');
    Route::get('comandas/{comanda}', 'show')->name('comandas.show');
    Route::put('comandas/{comanda}/edit', 'update')->name('comandas.update');
    Route::post('comandas/enviar', 'enviar')->name('comandas.enviar');
    Route::post('comandas/eliminar', 'eliminarComanda')->name('comandas.eliminarComanda');
    Route::post('comandas/eliminar/cuenta', 'eliminarCuenta')->name('comandas.eliminarCuenta');
  
});

Route::controller(CobrosController::class)->group(function () {

    Route::post('cobros/store', 'store')->name('cobros.store');
    Route::get('cobros', 'index')->name('cobros.index');

});

Route::controller(CajasController::class)->group(function () {

    Route::get('cajas/store', 'store')->name('cajas.store');
    Route::get('cajas', 'index')->name('cajas.index');

});

Route::controller(DatatableController::class)->group(function () {
    Route::get('datatable/zonas', 'zonas')->name('datatable.zonas');

});


Route::resource('products-ajax-crud', ProductAjaxController::class);