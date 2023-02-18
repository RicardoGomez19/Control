<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadosController;
use Illuminate\Support\Facades\Auth;

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

Route::group(
    ['middleware' => ['auth', 'verified']],
    function () {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/empleados', [App\Http\Controllers\EmpleadosController::class, 'index'])->name('empleados');

 Route::get('/empleados', function () {
     return view('sistema.vistas.empleados.empleados');
 });

Route::get('/entradas', function () {
     return view('sistema.vistas.entradas.entradas');
});

Route::get('/salidas', function () {
    return view('sistema.vistas.salidas.salidas');
});

Route::get('/reporte', function () {
    return view('sistema.vistas.reportes.reporte2');
});

Route::get('/pagos', function () {
    return view('sistema.vistas.pagos.pagos');
});


});

