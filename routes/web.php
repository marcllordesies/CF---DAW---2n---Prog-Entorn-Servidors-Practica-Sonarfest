<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\ArtistaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Bloque 2: Recurso completo de artistas con parámetros corregidos para evitar errores de URL
Route::resource('artistes', ArtistaController::class)->parameters([
    'artistes' => 'artista'
])->middleware('auth');

// Todas estas rutas solo funcionan si el usuario ha iniciado sesión (Breeze)
Route::middleware('auth')->group(function () {
    // Rutas de Perfil existentes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de Concerts (Bloc 4)
    Route::get('/concerts', [ConcertController::class, 'index'])->name('concerts.index');
    Route::get('/concerts/create', [ConcertController::class, 'create'])->name('concerts.create');
    Route::post('/concerts', [ConcertController::class, 'store'])->name('concerts.store');
    Route::get('/concerts/{concert}', [ConcertController::class, 'show'])->name('concerts.show');
});

require __DIR__.'/auth.php';
