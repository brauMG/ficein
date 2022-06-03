<?php

use App\Http\Controllers\ContactoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\CuentasInversionesController;
use App\Http\Controllers\ConstanciasInversionesController;
use App\Http\Controllers\CuentasCreditosController;
use App\Http\Controllers\DividendosController;
use App\Http\Controllers\InteresesController;
use App\Http\Controllers\BulkSmsController;

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

Auth::routes();

Route::group(['middleware' => 'auth', 'admin'], function () {
    Route::get('/','App\Http\Controllers\HomeController@index');

    //sms
    Route::get('/administrador/bulksms', [BulkSmsController::class, 'index']);
    Route::post('/administrador/send',[BulkSmsController::class, 'sendSms'])->name('SendSMS');

    // usuarios
    Route::get('/administrador/usuarios',[UsuariosController::class, 'index']);
    Route::get('/administrador/usuarios/nuevo',[UsuariosController::class, 'create']);
    Route::get('/administrador/usuarios/modificar/{id}',[UsuariosController::class, 'edit']);
    Route::get('/administrador/usuarios/eliminar/{id}',[UsuariosController::class, 'prepare']);
    Route::post('/administrador/usuarios/agregarCliente',[UsuariosController::class, 'store_client'])->name('AgregarCliente');
    Route::post('/administrador/usuarios/agregarAdministrador',[UsuariosController::class, 'store_admin'])->name('AgregarAdministrador');
    Route::put('/administrador/usuarios/actualizarCliente/{id}',[UsuariosController::class, 'update'])->name('ActualizarCliente');
    Route::post('/administrador/usuarios/eliminarCliente/{id}',[UsuariosController::class, 'delete'])->name('EliminarCliente');
    Route::post('/administrador/usuarios/importar',[UsuariosController::class, 'import']);

    // informacion de contacto
    Route::get('/administrador/contacto/modify',[ContactoController::class, 'modify'])->name('modificar_contacto');
    Route::put('/administrador/contacto/modify/{id}',[ContactoController::class, 'update'])->name('actualizar_contacto');

    // facturas
    Route::get('/administrador/facturas',[FacturasController::class, 'index']);
    Route::post('/administrador/facturas/verify',[FacturasController::class, 'verify'])->name('verificar_facturas');

    // cuentas de inversion
    Route::get('/administrador/cuentas_inversion',[CuentasInversionesController::class, 'index']);
    Route::post('/administrador/cuentas_inversion/verify',[CuentasInversionesController::class, 'verify'])->name('verificar_cuentas_inversiones');

    //cuentas de creditos
    Route::get('/administrador/cuentas_credito',[CuentasCreditosController::class, 'index']);
    Route::post('/administrador/cuentas_credito/verify',[CuentasCreditosController::class, 'verify'])->name('verificar_cuentas_creditos');

    // constancias de inversion
    Route::get('/administrador/constancia_inversion',[ConstanciasInversionesController::class, 'index']);
    Route::post('/administrador/constancia_inversion/verify',[ConstanciasInversionesController::class, 'verify'])->name('verificar_constancias_inversiones');

    // dividendos
    Route::get('/administrador/dividendos',[DividendosController::class, 'index']);
    Route::post('/administrador/dividendos/verify',[DividendosController::class, 'verify'])->name('verificar_dividendos');

    // intereses
    Route::get('/administrador/intereses',[InteresesController::class, 'index']);
    Route::post('/administrador/intereses/verify',[InteresesController::class, 'verify'])->name('verificar_intereses');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/','App\Http\Controllers\HomeController@index');

    // facturas
    Route::get('/cliente/facturas',[FacturasController::class, 'index_cliente']);
    Route::get('/cliente/facturas/pdf/download/{file}',[FacturasController::class, 'pdf_auth']);
    Route::get('/cliente/facturas/xml/download/{file}',[FacturasController::class, 'xml_auth']);

    // cuentas de inversion
    Route::get('/cliente/cuentas_inversion',[CuentasInversionesController::class, 'index_cliente']);
    Route::get('/cliente/cuentas_inversion/pdf/download/{file}',[CuentasInversionesController::class, 'pdf_auth']);

    // cuentas de credito
    Route::get('/cliente/cuentas_credito',[CuentasCreditosController::class, 'index_cliente']);
    Route::get('/cliente/cuentas_credito/pdf/download/{file}',[CuentasCreditosController::class, 'pdf_auth']);

    // constancias de inversion
    Route::get('/cliente/constancia_inversion',[ConstanciasInversionesController::class, 'index_cliente']);
    Route::get('/cliente/constancia_inversion/pdf/download/{file}',[ConstanciasInversionesController::class, 'pdf_auth']);

    // dividendos
    Route::get('/cliente/dividendos',[DividendosController::class, 'index_cliente']);
    Route::get('/cliente/dividendos/pdf/download/{file}',[DividendosController::class, 'pdf_auth']);
    Route::get('/cliente/dividendos/xml/download/{file}',[DividendosController::class, 'xml_auth']);

    // intereses
    Route::get('/cliente/intereses',[InteresesController::class, 'index_cliente']);
    Route::get('/cliente/intereses/pdf/download/{file}',[InteresesController::class, 'pdf_auth']);
    Route::get('/cliente/intereses/xml/download/{file}',[InteresesController::class, 'xml_auth']);

    // informacion de contacto
    Route::get('/cliente/contacto',[ContactoController::class, 'index']);
});

