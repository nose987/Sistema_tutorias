<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\CanalizacionController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('encuesta', 'encuesta')
    ->middleware(['auth', 'verified'])
    ->name('encuesta');


    
//rutas de la canalizaciones
Route::get('canalizaciones/{canalizacion}', [CanalizacionController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('canalizaciones.show');

Route::get('canalizaciones', [CanalizacionController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('canalizaciones');

Route::get('canalizaciones/{canalizacion}/formato', [CanalizacionController::class, 'showFormato'])
    ->middleware(['auth', 'verified'])
    ->name('canalizaciones.formato.show');

Route::post('canalizaciones/{canalizacion}/formato', [CanalizacionController::class, 'storeFormato'])
    ->middleware(['auth', 'verified'])
    ->name('canalizaciones.formato.store');

Route::view('historial_canalizaciones', 'historial_canalizaciones')
    ->middleware(['auth', 'verified'])
    ->name('historial_canalizaciones');

Route::post('/canalizaciones/{canalizacion}/seguimiento', [App\Http\Controllers\CanalizacionController::class, 'storeSeguimiento'])
    ->name('canalizaciones.seguimiento.store');

Route::get('/alumnos/{alumno}/historial', [App\Http\Controllers\CanalizacionController::class, 'showHistorial'])
    ->name('alumnos.historial');

Route::post('/alumnos/{alumno}/baja', [App\Http\Controllers\CanalizacionController::class, 'darDeBaja'])
    ->name('alumnos.baja');

Route::get('/reportes/canalizaciones-final', [CanalizacionController::class, 'exportarInformeFinalPlantilla'])
    ->name('canalizaciones.reporte.final');

Route::get('/canalizaciones/{canalizacion}/pdf', [CanalizacionController::class, 'exportarFormatoPDF'])
    ->name('canalizaciones.formato.pdf');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
