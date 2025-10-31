<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

// Importa los nuevos controladores
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ObservacionController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\EncuestaController;
use App\Http\Controllers\DashboardEncuestaController;
use App\Http\Controllers\CanalizacionController;
use App\Http\Controllers\ActividadController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


/*
|--------------------------------------------------------------------------
| Rutas Protegidas (Requieren autenticación)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Vistas simples
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('encuesta', 'encuesta')->name('encuesta');
    Route::view('canalizaciones', 'canalizaciones')->name('canalizaciones');

    // --- GRUPOS ---
    Route::get('grupo', [GrupoController::class, 'index'])->name('grupo');
    
    Route::get('detalle_grupo/{grupo}', [GrupoController::class, 'show'])->name('detalle_grupo');
    Route::get('editar_grupo/{grupo}', [GrupoController::class, 'edit'])->name('editar_grupo');
    
    // Ruta PUT para actualizar
    Route::put('editar_grupo/{grupo}', [GrupoController::class, 'update'])->name('grupos.update');

    // ===== NUEVA RUTA DE EXPORTACIÓN =====
    Route::get('grupo/{grupo}/exportar-alumnos', [GrupoController::class, 'exportAlumnos'])->name('grupos.exportAlumnos');
    // ===== FIN DE LA NUEVA RUTA =====


    // --- ALUMNOS ---
    Route::get('detalle_alumno/{alumno}', [AlumnoController::class, 'show'])->name('detalle_alumno');
    Route::patch('alumnos/{alumno}/estatus', [AlumnoController::class, 'updateStatus'])->name('alumnos.updateStatus');
    Route::get('alumnos/crear', [AlumnoController::class, 'create'])->name('alumnos.create');
    Route::post('alumnos', [AlumnoController::class, 'store'])->name('alumnos.store');
    
    // --- OBSERVACIONES ---
    Route::post('alumnos/{alumno}/observaciones', [ObservacionController::class, 'store'])->name('observaciones.store');
    Route::delete('observaciones/{observacion}', [ObservacionController::class, 'destroy'])->name('observaciones.destroy');

    // --- SETTINGS (PERFIL) ---
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