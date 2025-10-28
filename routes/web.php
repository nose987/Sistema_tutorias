<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\EncuestaController;
use App\Http\Controllers\DashboardEncuestaController;
use App\Http\Controllers\CanalizacionController;

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

Route::view('actividades', 'actividades')
    ->middleware(['auth', 'verified'])
    ->name('actividades');

Route::get('encuesta', [EncuestaController::class, 'create'])->name('encuesta.create');
Route::post('encuesta', [EncuestaController::class, 'store'])->name('encuesta.store');

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
