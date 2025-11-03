<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Http\Controllers\EmpresaController;
use App\Models\OpcionEstadia;
use App\Http\Controllers\ReporteEstadiaController;
// Importa los nuevos controladores
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ObservacionController;
use App\Models\Empresa;

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
    Route::post('grupo/{grupo}/duplicar', [GrupoController::class, 'duplicar'])->name('grupos.duplicar');

    // ===== NUEVA RUTA DE EXPORTACIÓN =====
    Route::get('grupo/{grupo}/exportar-alumnos', [GrupoController::class, 'exportAlumnos'])->name('grupos.exportAlumnos');

    Route::get('crear_grupo', [GrupoController::class, 'create'])->name('grupos.create');   // ← GET del formulario
    Route::post('grupo', [GrupoController::class, 'store'])->name('grupos.store');  
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

Route::get('encuesta/{alumno}', [EncuestaController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('encuesta.show');

Route::put('encuesta/{alumno}', [EncuestaController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('encuesta.update');
    
Route::get('encuesta', [EncuestaController::class, 'create'])->name('encuesta.create');
Route::post('encuesta', [EncuestaController::class, 'store'])->name('encuesta.store');

Route::get('actividades', [ActividadController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('actividades');

Route::get('actividades/reporte', [ActividadController::class, 'generarReporte'])
    ->middleware(['auth', 'verified'])
    ->name('actividades.reporte');

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

Route::get('estadias', function () {
    $alumnos = Alumno::with('opcionesEstadia.empresa')->get();
    $empresas = Empresa::all();

    return view('layouts.estadias', [
        'alumnos' => $alumnos,
        'empresas' => $empresas
    ]);
})->middleware(['auth', 'verified'])->name('estadias');

Route::get('estadias/reporte', [ReporteEstadiaController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('estadias.reporte');


Route::get('estadias/reporte/pdf', function() {
    return "Página de descarga de PDF (aún no implementada)";
})
->middleware(['auth', 'verified'])
->name('estadias.reporte.pdf');

Route::view('empresas/crear', 'layouts.nueva_empresa')
    ->middleware(['auth', 'verified'])
    ->name('empresas.create');

Route::put('/alumnos/{alumno}/opciones', function(Request $request, Alumno $alumno) {

    $validated = $request->validate([
        'opcion_1_id' => 'nullable|integer|exists:empresa,pk_empresa',
        'opcion_2_id' => 'nullable|integer|exists:empresa,pk_empresa',
        'opcion_3_id' => 'nullable|integer|exists:empresa,pk_empresa',
    ]);

    $alumno->opcionesEstadia()->updateOrCreate(
        ['opcion_numero' => 1],
        ['fk_empresa' => $validated['opcion_1_id']]
    );

    $alumno->opcionesEstadia()->updateOrCreate(
        ['opcion_numero' => 2],
        ['fk_empresa' => $validated['opcion_2_id']]
    );

    $alumno->opcionesEstadia()->updateOrCreate(
        ['opcion_numero' => 3],
        ['fk_empresa' => $validated['opcion_3_id']]
    );

    return response()->json([
        'success' => true,
        'message' => 'Opciones actualizadas correctamente'
    ]);
})->middleware(['auth', 'verified']);

Route::patch('/opciones-estadia/{opcion}/status', function(Request $request, OpcionEstadia $opcion) {

    $validated = $request->validate([
        'estatus' => 'required|string|in:Pendiente,Contactado,No Contactado,Aceptado,Rechazado'
    ]);

    $opcion->update([
        'estatus' => $validated['estatus']
    ]);

    return response()->json(['success' => true, 'message' => 'Estatus actualizado.']);

})->middleware(['auth', 'verified'])->name('opciones-estadia.updateStatus');

Route::post('empresas', function (Request $request) {
    $request->validate([
        'nombre_empresa' => 'required|string|max:150',
        'nombre_contacto' => 'nullable|string|max:200',
        'email' => 'nullable|email|max:100',
        'telefono' => 'nullable|string|max:20',
        'direccion' => 'nullable|string',
        'notas' => 'nullable|string',
    ]);

    Empresa::create([
        'nombre' => $request->input('nombre_empresa'),
        'nombre_contacto' => $request->input('nombre_contacto'),
        'tel' => $request->input('telefono'),
        'correo' => $request->input('email'),
        'direccion' => $request->input('direccion'),
        'notas' => $request->input('notas'),
        'estatus' => 'Activa'
    ]);

    return redirect()->route('estadias')->with('success', '¡Empresa registrada con éxito!');
})->middleware(['auth', 'verified'])->name('empresas.store');

Route::put('/empresas/{empresa}', [EmpresaController::class, 'update'])->name('empresas.update');
Route::delete('/empresas/{empresa}', [EmpresaController::class, 'destroy'])->name('empresas.destroy');

require __DIR__.'/auth.php';