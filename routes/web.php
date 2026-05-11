<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// ─── Rutas públicas ───────────────────────────────────────────────────────────
Route::get('/', \App\Http\Controllers\Publico\PortadaController::class)
    ->name('publico.portada');

Route::prefix('modulos')->name('publico.modulos.')->group(function () {
    Route::get('/',         [\App\Http\Controllers\Publico\ModuloController::class, 'index'])->name('index');
    Route::get('/{modulo}', [\App\Http\Controllers\Publico\ModuloController::class, 'show'])->name('show');
});

Route::get('/ecosistemas/{ecosistema}', \App\Http\Controllers\Publico\EcosistemaController::class)
    ->name('publico.ecosistemas.show');

// ─── Rutas del estudiante ─────────────────────────────────────────────────────
Route::middleware(['auth', 'role:estudiante'])
    ->prefix('estudiante')
    ->name('estudiante.')
    ->group(function () {
        Route::get('/dashboard',          \App\Http\Controllers\Estudiante\DashboardController::class)->name('dashboard');
        Route::get('/perfil/{perfil}',    \App\Http\Controllers\Estudiante\PerfilController::class)->name('perfil.show');
        Route::get('/modulos',         [\App\Http\Controllers\Estudiante\ModuloController::class, 'index'])->name('modulos.index');
        Route::get('/modulos/{modulo}', [\App\Http\Controllers\Estudiante\ModuloController::class, 'show'])->name('modulo');
    });

// ─── Rutas del docente ────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:docente'])
    ->prefix('docente')
    ->name('docente.')
    ->group(function () {
        Route::get('/dashboard',                \App\Http\Controllers\Docente\DashboardController::class)->name('dashboard');
        Route::get('/ecosistemas/{ecosistema}', \App\Http\Controllers\Docente\EcosistemaController::class)->name('ecosistemas.show');
        Route::get('/progreso/{ecosistema}',    \App\Http\Controllers\Docente\ProgresoController::class)->name('progreso.show');
    });

// Rutas de autenticación (generadas por Breeze)

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
