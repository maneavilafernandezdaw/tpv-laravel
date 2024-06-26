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

require __DIR__.'/auth.php';

Route::controller(Controller::class)->group(function () {

    Route::get('home/oscuro', 'temaOscuro')->name('tema.temaOscuro');
    Route::get('home/claro', 'temaClaro')->name('tema.temaClaro');


});

Route::controller(ZonasController::class)->group(function () {


    Route::get('zonas', 'index')->name('zonas.index');
    Route::post('zonas', 'store')->name('zonas.store');
    Route::get('zonas/{zona}', 'show')->name('zonas.show');   
    Route::put('zonas/update/{zona}', 'update')->name('zonas.update');
    Route::delete('zonas/destroy/{zona}', 'destroy')->name('zonas.destroy');
});

Route::controller(FamiliasController::class)->group(function () {
    Route::get('familias', 'index')->name('familias.index');
    Route::post('familias/store', 'store')->name('familias.store');
    Route::get('familias/{familia}/edit', 'edit')->name('familias.edit');
    Route::put('familias/update/{familia}', 'update')->name('familias.update');
    Route::delete('familias/destroy/{familia}', 'destroy')->name('familias.destroy');
});

Route::controller(ClientesController::class)->group(function () {
    Route::get('clientes', 'index')->name('clientes.index');
    Route::post('clientes/store', 'store')->name('clientes.store');
    Route::put('clientes/update/{cliente}', 'update')->name('clientes.update');
    Route::delete('clientes/destroy/{cliente}', 'destroy')->name('clientes.destroy');
});

Route::controller(ProductosController::class)->group(function () {
    Route::get('productos', 'index')->name('productos.index');
    Route::post('productos', 'store')->name('productos.store');
    Route::post('productos/coctel', 'coctel')->name('productos.coctel');
    Route::put('productos/update/{producto}', 'update')->name('productos.update');
    Route::delete('productos/destroy/{producto}', 'destroy')->name('productos.destroy');
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
    Route::put('comandas/update/{comanda}', 'update')->name('comandas.update');
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




