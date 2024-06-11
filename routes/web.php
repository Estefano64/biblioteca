<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoansController;

//FALTA FILTRO DE ADMINS
// Ruta para la página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Grupo de rutas que requieren autenticación y verificación
Route::middleware([
    'auth:sanctum', // Middleware de autenticación con Sanctum
    config('jetstream.auth_session'), // Configuración de sesión de Jetstream
    'verified', // Middleware para usuarios verificados
])->group(function () {
    // Ruta al dashboard después de la autenticación y verificación
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Grupo de rutas que requieren autenticación
Route::middleware('auth')->group(function () {
    // Ruta al dashboard utilizando el controlador BookController
    Route::get('/dashboard', [BookController::class, 'showBooks'])->name('dashboard');
    
    // Rutas de recurso para libros, excluyendo la vista individual
    Route::resource('books', BookController::class)->except(['show']);
    
    // Rutas de recurso para préstamos
    Route::resource('loans', LoansController::class);
});

// Ruta individual para mostrar un libro específico
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

// Ruta para la página principal que muestra libros
Route::get('/home', [BookController::class, 'showBooks'])->name('home');


