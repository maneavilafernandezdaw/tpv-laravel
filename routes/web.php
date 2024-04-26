<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ZonasController;
use App\Http\Controllers\FamiliasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ComandasController;
use App\Http\Controllers\CobrosController;
use App\Http\Controllers\CajasController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Controller;

use App\Http\Controllers\ZonasAjaxController;
use App\Http\Controllers\FamiliasAjaxController;
use App\Http\Controllers\ClientesAjaxController;
use App\Http\Controllers\ProductosAjaxController;

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
})->name('welcome');

Route::get('/impticket', function () {
    return view('comandas/impticket');
});

Route::get('/impcuenta', function () {
    return view('comandas/impcuenta');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/usuarios', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/register', [ProfileController::class, 'register'])->name('profile.register');
    Route::post('/profile/store', [ProfileController::class, 'store'])->name('profile.store');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/usuarios/{usuario}/eliminar',  [ProfileController::class, 'eliminar'])->name('profile.eliminar');
});

require __DIR__ . '/auth.php';

Route::controller(Controller::class)->group(function () {

    Route::get('home/oscuro', 'temaOscuro')->name('tema.temaOscuro');
    Route::get('home/claro', 'temaClaro')->name('tema.temaClaro');
});

Route::controller(ZonasController::class)->group(function () {


    Route::get('zonas', 'index')->name('zonas.index');
    Route::post('zonas/store', 'store')->name('zonas.store');
    Route::get('zonas/{zona}', 'show')->name('zonas.show');
    Route::put('zonas/update/{zona}', 'update')->name('zonas.update');
    Route::delete('zonas/destroy', 'destroy')->name('zonas.destroy');
});




Route::controller(FamiliasController::class)->group(function () {
    Route::get('familias', 'index')->name('familias.index');
    Route::post('familias/store', 'store')->name('familias.store');
    Route::put('familias/update/{familia}', 'update')->name('familias.update');
    Route::delete('familias/destroy', 'destroy')->name('familias.destroy');
});

Route::controller(ClientesController::class)->group(function () {
    Route::get('clientes', 'index')->name('clientes.index');
    Route::post('clientes/store', 'store')->name('clientes.store');
    Route::put('clientes/update/{cliente}', 'update')->name('clientes.update');
    Route::delete('clientes/destroy', 'destroy')->name('clientes.destroy');
});

Route::controller(ProductosController::class)->group(function () {
    Route::get('productos', 'index')->name('productos.index');
    Route::post('productos/store', 'store')->name('productos.store');
    Route::post('productos/coctel', 'coctel')->name('productos.coctel');
    Route::put('productos/update/{producto}', 'update')->name('productos.update');
    Route::delete('productos/destroy', 'destroy')->name('productos.destroy');
});

Route::controller(ComandasController::class)->group(function () {
    Route::get('comandas', 'index')->name('comandas.index');
    Route::get('comandas/create/{zona}/{mesa}/{familia}', 'create')->name('comandas.create');
    Route::get('comandas/cuenta/{zona}/{mesa}', 'consultarCuenta')->name('comandas.consultarCuenta');
    Route::get('comandas/pedido/{zona}/{mesa}/{familia}', 'pedido')->name('comandas.pedido');
    Route::get('comandas/ticket/{zona}/{mesa}/{usuario}', 'ticket')->name('comandas.ticket');
    Route::get('comandas/ticketCuenta/{zona}/{mesa}/{usuario}', 'ticketCuenta')->name('comandas.ticketCuenta');
    Route::post('comandas/store', 'store')->name('comandas.store');
    Route::post('comandas/incrementar', 'incrementar')->name('comandas.incrementar');
    Route::post('comandas/decrementar', 'decrementar')->name('comandas.decrementar');
    Route::post('comandas/incrementarTabla', 'incrementarTabla')->name('comandas.incrementarTabla');
    Route::post('comandas/decrementarTabla', 'decrementarTabla')->name('comandas.decrementarTabla');
    Route::post('comandas/enviar', 'enviar')->name('comandas.enviar');
    Route::post('comandas/imprimirCuenta', 'imprimirCuenta')->name('comandas.imprimirCuenta');
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

Route::controller(FacturaController::class)->group(function () {

    Route::get('factura', 'index')->name('factura.index');
    Route::post('factura/descargar', 'descargar')->name('factura.descargar');
    Route::post('factura/enviar-pdf', 'enviarPDF')->name('factura.enviar-pdf');
});

Route::controller(ReportController::class)->group(function () {

    Route::get('report', 'report')->name('report.index');
    Route::post('report/send_report', 'sendReport')->name('report.sendReport');
});

Route::controller(ZonasAjaxController::class)->group(function () {

    Route::get('zonasAjax', 'index')->name('zonasAjax.index');
    Route::post('zonasAjax/store', 'store')->name('zonasAjax.store');
    Route::get('zonasAjax/edit/{id}/', 'edit');
    Route::post('zonasAjax/update', 'update')->name('zonasAjax.update');
    Route::post('zonasAjax/destroy/{id}/', 'destroy');


    Route::post('/', 'accion');
});

Route::controller(FamiliasAjaxController::class)->group(function () {

    Route::get('familiasAjax', 'index')->name('familiasAjax.index');
    Route::post('familiasAjax/store', 'store')->name('familiasAjax.store');
    Route::get('familiasAjax/edit/{id}/', 'edit');
    Route::post('familiasAjax/update', 'update')->name('familiasAjax.update');
    Route::post('familiasAjax/destroy/{id}/', 'destroy');


    Route::post('/', 'accion');
});

Route::controller(ClientesAjaxController::class)->group(function () {

    Route::get('clientesAjax', 'index')->name('clientesAjax.index');
    Route::post('clientesAjax/store', 'store')->name('clientesAjax.store');
    Route::get('clientesAjax/edit/{id}/', 'edit');
    Route::post('clientesAjax/update', 'update')->name('clientesAjax.update');
    Route::post('clientesAjax/destroy/{id}/', 'destroy');


    Route::post('/', 'accion');
});

Route::controller(ProductosAjaxController::class)->group(function () {

    Route::get('productosAjax', 'index')->name('productosAjax.index');
    Route::post('productosAjax/store', 'store')->name('productosAjax.store');
    Route::post('productosAjax/coctel', 'coctel')->name('productosAjax.coctel');
    Route::get('productosAjax/edit/{id}/', 'edit');
    Route::post('productosAjax/update', 'update')->name('productosAjax.update');
    Route::post('productosAjax/destroy/{id}/', 'destroy');


    Route::post('/', 'accion');
});
