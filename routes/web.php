<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {    return view('welcome');});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Ruta Principal protegida por autenticación
//Route::get('/', function () {    return view('admin');});
//Rutas para el administrador, el name('admin.index') es importante para el momento de definir los roles y permisos - el middleware('auth') obliga a la autenticación
//lo que va en el primer '' debe ir tambien en el formulario, puede llevar el id
//lo que va en el segundo '' es la función que está en el controlador
Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');

//Rutas Usuarios
Route::get('admin/usuarios', [\App\Http\Controllers\UsuarioController::class, 'index'])->name('usuarios.index')->middleware('auth','can:usuarios.index');
Route::get('admin/usuarios/create', [\App\Http\Controllers\UsuarioController::class, 'create'])->name('usuarios.create')->middleware('auth','can:usuarios.create');
Route::post('admin/usuarios', [\App\Http\Controllers\UsuarioController::class, 'store'])->name('usuarios.store')->middleware('auth','can:usuarios.store');
Route::get('admin/usuarios/{id}', [\App\Http\Controllers\UsuarioController::class, 'show'])->name('usuarios.show')->middleware('auth','can:usuarios.show');
Route::get('admin/usuarios/{id}/edit', [\App\Http\Controllers\UsuarioController::class, 'edit'])->name('usuarios.edit')->middleware('auth','can:usuarios.edit');
Route::put('admin/usuarios/{id}', [\App\Http\Controllers\UsuarioController::class, 'update'])->name('usuarios.update')->middleware('auth','can:usuarios.update');
Route::delete('admin/usuarios/{id}', [\App\Http\Controllers\UsuarioController::class, 'destroy'])->name('usuarios.destroy')->middleware('auth','can:usuarios.destroy');

//Rutas Usuarios sin autenticar
//Route::get('/registro', [\App\Http\Controllers\UsuarioController::class, 'registro'])->name('admin.index');
//Route::post('/registro', [\App\Http\Controllers\UsuarioController::class, 'registro_create'])->name('registro');

//Rutas Mi Unidad -Carpetas
Route::get('admin/mi_unidad', [\App\Http\Controllers\CarpetaController::class, 'index'])->name('mi_unidad.index')->middleware('auth');
Route::post('admin/mi_unidad', [\App\Http\Controllers\CarpetaController::class, 'store'])->name('mi_unidad.store')->middleware('auth');
Route::get('admin/mi_unidad/carpeta/{id}', [\App\Http\Controllers\CarpetaController::class, 'show'])->name('mi_unidad.carpeta')->middleware('auth');
Route::put('admin/mi_unidad/carpeta/update_subcarpeta', [\App\Http\Controllers\CarpetaController::class, 'update_subcarpeta'])->name('mi_unidad.carpeta.update_subcarpeta')->middleware('auth');
Route::put('admin/mi_unidad/carpeta', [\App\Http\Controllers\CarpetaController::class, 'update_subcarpeta_color'])->name('mi_unidad.carpeta.update_subcarpeta_color')->middleware('auth');
Route::post('admin/mi_unidad/carpeta/crear_subcarpeta', [\App\Http\Controllers\CarpetaController::class, 'crear_subcarpeta'])->name('mi_unidad.carpeta.crear_subcarpeta')->middleware('auth');
Route::put('admin/mi_unidad/update_padre', [\App\Http\Controllers\CarpetaController::class, 'update'])->name('mi_unidad.update')->middleware('auth');
Route::put('admin/mi_unidad', [\App\Http\Controllers\CarpetaController::class, 'update_color'])->name('mi_unidad.update_color')->middleware('auth');

//Rutas para Eliminar Carpetas
Route::delete('admin/mi_unidad/eliminar_carpeta/{id}', [\App\Http\Controllers\CarpetaController::class, 'destroy'])->name('mi_unidad.carpeta.destroy')->middleware('auth');

//Rutas para Archivos
Route::post('admin/mi_unidad/carpeta/upload', [\App\Http\Controllers\ArchivoController::class, 'upload'])->name('mi_unidad.archivo.upload')->middleware('auth');
//Rutas para Eliminar Archivos
Route::delete('admin/mi_unidad/carpeta', [\App\Http\Controllers\ArchivoController::class, 'eliminar_archivos'])->name('mi_unidad.archivo.eliminar_archivos')->middleware('auth');

//Ruta para cambiar el estado de un Archivo de forma Privada a Pública
Route::get('admin/mi_unidad/carpeta', [\App\Http\Controllers\ArchivoController::class, 'cambiar_de_privado_a_publico'])->name('mi_unidad.archivo.cambiar.privado.publico')->middleware('auth');
//Ruta para cambiar el estado de un Archivo de forma Pública a Privada
Route::post('admin/mi_unidad/carpeta', [\App\Http\Controllers\ArchivoController::class, 'cambiar_de_publico_a_privado'])->name('mi_unidad.archivo.cambiar.publico.privado')->middleware('auth');

//Ruta para mostrar Archivos Privados solo si el usuario está autenticado
Route::get('storage/{carpeta}/{archivo}',function ($carpeta,$archivo){
    if(Auth::check()){
        $path=storage_path('app'.DIRECTORY_SEPARATOR.$carpeta.DIRECTORY_SEPARATOR.$archivo);
        return response()->file($path);
    }else{
        abort(403,'No tiene permisos para acceder a este archivo, por favor comuniquese con el administrador del sistema');
    }
})->name('mostrar.archivos.privados');
