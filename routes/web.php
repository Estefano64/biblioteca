<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Livewire\BookSearch;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [BookController::class, 'showBooks'])->name('dashboard');
    Route::resource('books', BookController::class)->except(['show']);
 });
 Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

 Route::get('/home', [BookController::class, 'showBooks'])->name('home');


 Route::get('/search', \App\Http\Livewire\BookSearch::class);