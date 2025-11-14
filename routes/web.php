<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Alumno;
use App\Models\OpcionEstadia;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ReporteEstadiaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ObservacionController;
use App\Http\Controllers\EncuestaController;
use App\Http\Controllers\DashboardEncuestaController;
use App\Http\Controllers\CanalizacionController;
use App\Http\Controllers\ActividadController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');


/*
|--------------------------------------------------------------------------
| Rutas Protegidas (Requieren autenticación)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    
    // --- Vistas Simples ---
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('encuesta', 'encuesta')->name('encuesta');
    Route::view('canalizaciones', 'canalizaciones')->name('canalizaciones');
    Route::view('historial_canalizaciones', 'historial_canalizaciones')->name('historial_canalizaciones');

    // --- GRUPOS ---
    Route::get('grupo', [GrupoController::class, 'index'])->name('grupo');
    Route::get('detalle_grupo/{grupo}', [GrupoController::class, 'show'])->name('detalle_grupo');
    Route::get('editar_grupo/{grupo}', [GrupoController::class, 'edit'])->name('editar_grupo');
    Route::put('editar_grupo/{grupo}', [GrupoController::class, 'update'])->name('grupos.update');
    Route::post('grupo/{grupo}/duplicar', [GrupoController::class, 'duplicar'])->name('grupos.duplicar');
    Route::get('grupo/{grupo}/exportar-alumnos', [GrupoController::class, 'exportAlumnos'])->name('grupos.exportAlumnos');
    Route::get('crear_grupo', [GrupoController::class, 'create'])->name('grupos.create');
    Route::post('grupo', [GrupoController::class, 'store'])->name('grupos.store');

    // --- ALUMNOS (Información general) ---
    Route::get('detalle_alumno/{alumno}', [AlumnoController::class, 'show'])->name('detalle_alumno');
    Route::patch('alumnos/{alumno}/estatus', [AlumnoController::class, 'updateStatus'])->name('alumnos.updateStatus');
    Route::get('alumnos/crear', [AlumnoController::class, 'create'])->name('alumnos.create');
    Route::post('alumnos', [AlumnoController::class, 'store'])->name('alumnos.store');
    
    // --- OBSERVACIONES ---
    Route::post('alumnos/{alumno}/observaciones', [ObservacionController::class, 'store'])->name('observaciones.store');
    Route::delete('observaciones/{observacion}', [ObservacionController::class, 'destroy'])->name('observaciones.destroy');

    // --- ESTADÍAS (Gestión de Opciones y Empresas) ---
    
    // Vista Principal de Gestión de Estadías (Optimizado)
    Route::get('estadias', function () {
        $alumnos = Alumno::with('opcionesEstadia.empresa')->orderBy('apellido_paterno')->get();
        $empresas = Empresa::where('estatus', 'Activa')->orderBy('nombre')->get();

        return view('layouts.estadias', [
            'alumnos' => $alumnos,
            'empresas' => $empresas
        ]);
    })->name('estadias');

    // Actualizar Opciones de Estadía del Alumno
    Route::put('/alumnos/{alumno}/opciones', function(Request $request, Alumno $alumno) {
        $validated = $request->validate([
            'opcion_1_id' => 'nullable|integer|exists:empresa,pk_empresa',
            'opcion_2_id' => 'nullable|integer|exists:empresa,pk_empresa',
            'opcion_3_id' => 'nullable|integer|exists:empresa,pk_empresa',
        ]);

        // Limpiar valores vacíos para que sean NULL
        $validated['opcion_1_id'] = $validated['opcion_1_id'] ?: null;
        $validated['opcion_2_id'] = $validated['opcion_2_id'] ?: null;
        $validated['opcion_3_id'] = $validated['opcion_3_id'] ?: null;

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
    });

    // Actualizar Estatus de una Opción de Estadía
    Route::patch('/opciones-estadia/{opcion}/status', function(Request $request, OpcionEstadia $opcion) {
        $validated = $request->validate([
            'estatus' => 'required|string|in:Pendiente,Contactado,No Contactado,Aceptado,Rechazado'
        ]);

        $opcion->update([
            'estatus' => $validated['estatus']
        ]);

        return response()->json(['success' => true, 'message' => 'Estatus actualizado.']);

    })->name('opciones-estadia.updateStatus');

    // Gestión de Empresas
    Route::view('empresas/crear', 'layouts.nueva_empresa')->name('empresas.create');
    
    // Crear Empresa (Store)
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
    })->name('empresas.store');

    // Actualizar y Eliminar Empresa (Controller)
    Route::put('/empresas/{empresa}', [EmpresaController::class, 'update'])->name('empresas.update');
    Route::delete('/empresas/{empresa}', [EmpresaController::class, 'destroy'])->name('empresas.destroy');


    // --- ESTADÍAS (Reportes) ---

    // Dashboard de Estadísticas
    Route::get('estadias/reporte', [ReporteEstadiaController::class, 'index'])->name('estadias.reporte'); 
    
    // Reporte Final de Alumnos
    Route::get('/estadias/reporte-final', [ReporteEstadiaController::class, 'finales'])->name('estadias.reporte.final'); 
    
    // Confirmar Final
    Route::patch('/alumnos/{alumno}/confirmar-final', [ReporteEstadiaController::class, 'confirmarFinal'])->name('alumnos.confirmarFinal');
    
    // Revertir Final
    Route::patch('/alumnos/{alumno}/revertir-final', function(Alumno $alumno) {
        
        $opcionAceptada = $alumno->opcionesEstadia()
                                ->where('estatus', 'Aceptado')
                                ->first();
        
        if (!$opcionAceptada) {
            return response()->json(['success' => false, 'message' => 'Error: No se encontró la opción aceptada para revertir.'], 422);
        }

        // Buscar todas las opciones Rechazadas (que fueron finalizadas) 
        // y cambiarlas de nuevo a Pendiente
        $alumno->opcionesEstadia()
            ->where('pk_opcion_estadia', '!=', $opcionAceptada->pk_opcion_estadia)
            ->where('estatus', 'Rechazado')
            ->update(['estatus' => 'Pendiente']); // <-- La acción clave de REVERTIR

        return response()->json([
            'success' => true,
            'message' => '¡Reversión exitosa! El alumno está de vuelta en gestión.'
        ]);

    })->name('alumnos.revertirFinal');
    
    // Placeholder de PDF
    Route::get('estadias/reporte/pdf', function() {
        return "Página de descarga de PDF (aún no implementada)";
    })->name('estadias.reporte.pdf');


    // --- ENCUESTAS ---
    Route::get('encuestas', [DashboardEncuestaController::class, 'index'])->name('encuestas');
    Route::post('encuestas/settings', [DashboardEncuestaController::class, 'updateAlumnosEsperados'])->name('encuestas.settings.update');
    Route::get('encuesta/{alumno}', [EncuestaController::class, 'show'])->name('encuesta.show');
    Route::put('encuesta/{alumno}', [EncuestaController::class, 'update'])->name('encuesta.update');
    Route::get('encuesta', [EncuestaController::class, 'create'])->name('encuesta.create');
    Route::post('encuesta', [EncuestaController::class, 'store'])->name('encuesta.store');

    // --- ACTIVIDADES ---
    Route::get('actividades', [ActividadController::class, 'index'])->name('actividades');
    Route::get('actividades/reporte', [ActividadController::class, 'generarReporte'])->name('actividades.reporte');
    Route::get('actividades/create', [ActividadController::class, 'create'])->name('actividades.create');
    Route::post('actividades', [ActividadController::class, 'store'])->name('actividades.store');
    Route::get('actividades/{actividad:pk_actividad}', [ActividadController::class, 'show'])->name('actividades.show');
    Route::get('actividades/{actividad:pk_actividad}/edit', [ActividadController::class, 'edit'])->name('actividades.edit');
    Route::put('actividades/{actividad:pk_actividad}', [ActividadController::class, 'update'])->name('actividades.update');
    
    // --- CANALIZACIONES ---
    Route::get('canalizaciones/{canalizacion}', [CanalizacionController::class, 'show'])->name('canalizaciones.show');
    Route::get('canalizaciones', [CanalizacionController::class, 'index'])->name('canalizaciones');
    Route::get('canalizaciones/{canalizacion}/formato', [CanalizacionController::class, 'showFormato'])->name('canalizaciones.formato.show');
    Route::post('canalizaciones/{canalizacion}/formato', [CanalizacionController::class, 'storeFormato'])->name('canalizaciones.formato.store');
    Route::post('/canalizaciones/{canalizacion}/seguimiento', [CanalizacionController::class, 'storeSeguimiento'])->name('canalizaciones.seguimiento.store');
    Route::get('/alumnos/{alumno}/historial', [CanalizacionController::class, 'showHistorial'])->name('alumnos.historial');
    Route::post('/alumnos/{alumno}/baja', [CanalizacionController::class, 'darDeBaja'])->name('alumnos.baja');
    Route::get('/reportes/canalizaciones-final', [CanalizacionController::class, 'exportarInformeFinalPlantilla'])->name('canalizaciones.reporte.final');
    Route::get('/canalizaciones/{canalizacion}/pdf', [CanalizacionController::class, 'exportarFormatoPDF'])->name('canalizaciones.formato.pdf');

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