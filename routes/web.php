<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\EncuestaController;
use App\Http\Controllers\DashboardEncuestaController;
use App\Http\Controllers\CanalizacionController;
use App\Http\Controllers\ActividadController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('encuestas', [DashboardEncuestaController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('encuestas');

Route::post('encuestas/settings', [DashboardEncuestaController::class, 'updateAlumnosEsperados'])
    ->middleware(['auth', 'verified'])
    ->name('encuestas.settings.update');

Route::get('actividades', [ActividadController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('actividades');

Route::get('actividades/create', [ActividadController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('actividades.create');

Route::post('actividades', [ActividadController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('actividades.store');

Route::get('actividades/{actividad:pk_actividad}', [ActividadController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('actividades.show');

Route::get('actividades/{actividad:pk_actividad}/edit', [ActividadController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('actividades.edit');

Route::put('actividades/{actividad:pk_actividad}', [ActividadController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('actividades.update');

Route::get('actividades/reporte', [ActividadController::class, 'generarReporte'])
    ->middleware(['auth', 'verified'])
    ->name('actividades.reporte');



Route::get('encuesta', [EncuestaController::class, 'create'])->name('encuesta.create');
Route::post('encuesta', [EncuestaController::class, 'store'])->name('encuesta.store');
Route::get('encuesta/{alumno}', [DashboardEncuestaController::class, 'show'])->middleware(['auth', 'verified'])->name('encuesta.show');
Route::put('encuesta/{alumno}', [DashboardEncuestaController::class, 'update'])->middleware(['auth', 'verified'])->name('encuesta.update');

Route::get('canalizaciones', [CanalizacionController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('canalizaciones');

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
