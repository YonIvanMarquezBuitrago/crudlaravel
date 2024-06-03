<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {    return view('welcome');});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Ruta Principal protegida por autenticación
//Route::get('/', function () {    return view('admin');});
Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');

//Rutas Usuarios
Route::get('admin/usuarios', [\App\Http\Controllers\UsuarioController::class, 'index'])->name('usuarios.index')->middleware('auth');
Route::get('admin/usuarios/create', [\App\Http\Controllers\UsuarioController::class, 'create'])->name('usuarios.create')->middleware('auth');
Route::post('admin/usuarios', [\App\Http\Controllers\UsuarioController::class, 'store'])->name('usuarios.store')->middleware('auth');
Route::get('admin/usuarios/{id}', [\App\Http\Controllers\UsuarioController::class, 'show'])->name('usuarios.show')->middleware('auth');
Route::get('admin/usuarios/{id}/edit', [\App\Http\Controllers\UsuarioController::class, 'edit'])->name('usuarios.edit')->middleware('auth');
Route::put('admin/usuarios/{id}', [\App\Http\Controllers\UsuarioController::class, 'update'])->name('usuarios.update')->middleware('auth');
Route::delete('admin/usuarios/{id}', [\App\Http\Controllers\UsuarioController::class, 'destroy'])->name('usuarios.destroy')->middleware('auth');

//Rutas Usuarios sin autenticar
Route::get('/registro', [\App\Http\Controllers\UsuarioController::class, 'registro'])->name('admin.index');
Route::post('/registro', [\App\Http\Controllers\UsuarioController::class, 'registro_create'])->name('registro');

//Rutas Mi Unidad
Route::get('admin/mi_unidad', [\App\Http\Controllers\CarpetaController::class, 'index'])->name('mi_unidad.index')->middleware('auth');
Route::post('admin/mi_unidad', [\App\Http\Controllers\CarpetaController::class, 'store'])->name('mi_unidad.store')->middleware('auth');
Route::get('admin/mi_unidad/carpeta/{id}', [\App\Http\Controllers\CarpetaController::class, 'show'])->name('mi_unidad.carpeta')->middleware('auth');
Route::put('admin/mi_unidad/carpeta', [\App\Http\Controllers\CarpetaController::class, 'update_subcarpeta'])->name('mi_unidad.carpeta.update_subcarpeta')->middleware('auth');
Route::put('admin/mi_unidad/carpeta', [\App\Http\Controllers\CarpetaController::class, 'update_subcarpeta_color'])->name('mi_unidad.carpeta.update_subcarpeta_color')->middleware('auth');
Route::get('admin/mi_unidad/carpeta', [\App\Http\Controllers\CarpetaController::class, 'crear_subcarpeta'])->name('mi_unidad.carpeta.crear_subcarpeta')->middleware('auth');
Route::put('admin/mi_unidad', [\App\Http\Controllers\CarpetaController::class, 'update'])->name('mi_unidad.update')->middleware('auth');
Route::put('admin/mi_unidad', [\App\Http\Controllers\CarpetaController::class, 'update_color'])->name('mi_unidad.update_color')->middleware('auth');

//Rutas para Archivos
Route::post('admin/mi_unidad/carpeta', [\App\Http\Controllers\ArchivoController::class, 'upload'])->name('mi_unidad.archivo.upload')->middleware('auth');
//Rutas para Eliminar Archivos
Route::delete('admin/mi_unidad/carpeta', [\App\Http\Controllers\ArchivoController::class, 'eliminar_archivos'])->name('mi_unidad.archivo.eliminar_archivos')->middleware('auth');
