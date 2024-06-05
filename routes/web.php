<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\tablaController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/vista', [EstudianteController::class, 'index']); 

// Ruta para procesar el formulario de registro de estudiantes (POST)
Route::post('/guardar-estudiante', [EstudianteController::class, 'store'])->name('guardar.estudiante'); 

// Rutas para la tabla de estudiantes (CRUD)
Route::get('/tabla', [TablaController::class, 'index'])->name('estudiantes.index');
Route::put('/tabla/{id}', [TablaController::class, 'update'])->name('estudiantes.update');
Route::delete('/tabla/{id}', [TablaController::class, 'destroy'])->name('estudiantes.destroy');