<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {    return view('welcome');});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Ruta Principal protegida por autenticación
//Route::get('/', function () {    return view('admin');});
Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');

//Ruta Usuarios
Route::get('admin/usuarios', [\App\Http\Controllers\UsuarioController::class, 'index'])->name('usuarios.index')->middleware('auth');
Route::get('admin/usuarios/create', [\App\Http\Controllers\UsuarioController::class, 'create'])->name('usuarios.create')->middleware('auth');
Route::post('admin/usuarios', [\App\Http\Controllers\UsuarioController::class, 'store'])->name('usuarios.store')->middleware('auth');
Route::get('admin/usuarios/{id}', [\App\Http\Controllers\UsuarioController::class, 'show'])->name('usuarios.show')->middleware('auth');
Route::get('admin/usuarios/{id}/edit', [\App\Http\Controllers\UsuarioController::class, 'edit'])->name('usuarios.edit')->middleware('auth');
Route::put('admin/usuarios/{id}', [\App\Http\Controllers\UsuarioController::class, 'update'])->name('usuarios.update')->middleware('auth');
Route::delete('admin/usuarios/{id}', [\App\Http\Controllers\UsuarioController::class, 'destroy'])->name('usuarios.destroy')->middleware('auth');
