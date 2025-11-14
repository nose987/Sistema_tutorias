<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use Illuminate\Http\Request;

// --- Modelos ---
use App\Models\Alumno;
use App\Models\Empresa;
use App\Models\OpcionEstadia;

// --- Controladores ---
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\CanalizacionController;
use App\Http\Controllers\DashboardEncuestaController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EncuestaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\ObservacionController;
use App\Http\Controllers\ReporteEstadiaController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
|
| Rutas accesibles para cualquier visitante.
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');


/*
|--------------------------------------------------------------------------
| Rutas Protegidas
|--------------------------------------------------------------------------
|
| Estas rutas requieren autenticación y verificación de email.
|
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // --- Vistas Principales (Dashboard y Vistas Simples) ---
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('encuesta', 'encuesta')->name('encuesta');
    Route::view('historial_canalizaciones', 'historial_canalizaciones')->name('historial_canalizaciones');

    // --- Módulo: Grupos ---
    Route::get('grupo', [GrupoController::class, 'index'])->name('grupo');
    Route::get('crear_grupo', [GrupoController::class, 'create'])->name('grupos.create');
    Route::post('grupo', [GrupoController::class, 'store'])->name('grupos.store');
    Route::get('detalle_grupo/{grupo}', [GrupoController::class, 'show'])->name('detalle_grupo');
    Route::get('editar_grupo/{grupo}', [GrupoController::class, 'edit'])->name('editar_grupo');
    Route::put('editar_grupo/{grupo}', [GrupoController::class, 'update'])->name('grupos.update');
    Route::post('grupo/{grupo}/duplicar', [GrupoController::class, 'duplicar'])->name('grupos.duplicar');
    Route::get('grupo/{grupo}/exportar-alumnos', [GrupoController::class, 'exportAlumnos'])->name('grupos.exportAlumnos');

    // --- Módulo: Alumnos y Observaciones ---
    Route::get('detalle_alumno/{alumno}', [AlumnoController::class, 'show'])->name('detalle_alumno');
    Route::patch('alumnos/{alumno}/estatus', [AlumnoController::class, 'updateStatus'])->name('alumnos.updateStatus');
    Route::get('alumnos/crear', [AlumnoController::class, 'create'])->name('alumnos.create');
    Route::post('alumnos', [AlumnoController::class, 'store'])->name('alumnos.store');
    Route::post('alumnos/{alumno}/observaciones', [ObservacionController::class, 'store'])->name('observaciones.store');
    Route::delete('observaciones/{observacion}', [ObservacionController::class, 'destroy'])->name('observaciones.destroy');

    // --- Módulo: Encuestas ---
    Route::get('encuestas', [DashboardEncuestaController::class, 'index'])->name('encuestas');
    Route::post('encuestas/settings', [DashboardEncuestaController::class, 'updateAlumnosEsperados'])->name('encuestas.settings.update');
    Route::get('encuesta/crear', [EncuestaController::class, 'create'])->name('encuesta.create'); // Corregido para coincidir (antes era 'encuesta')
    Route::post('encuesta', [EncuestaController::class, 'store'])->name('encuesta.store');
    Route::get('encuesta/{alumno}', [EncuestaController::class, 'show'])->name('encuesta.show');
    Route::put('encuesta/{alumno}', [EncuestaController::class, 'update'])->name('encuesta.update');

    // --- Módulo: Actividades ---
    Route::get('actividades', [ActividadController::class, 'index'])->name('actividades');
    Route::get('actividades/reporte', [ActividadController::class, 'generarReporte'])->name('actividades.reporte');
    Route::get('actividades/create', [ActividadController::class, 'create'])->name('actividades.create');
    Route::post('actividades', [ActividadController::class, 'store'])->name('actividades.store');
    Route::get('actividades/{actividad:pk_actividad}', [ActividadController::class, 'show'])->name('actividades.show');
    Route::get('actividades/{actividad:pk_actividad}/edit', [ActividadController::class, 'edit'])->name('actividades.edit');
    Route::put('actividades/{actividad:pk_actividad}', [ActividadController::class, 'update'])->name('actividades.update');

    // --- Módulo: Canalizaciones ---
    Route::get('canalizaciones', [CanalizacionController::class, 'index'])->name('canalizaciones'); // Corregido: Eliminada la ruta 'view' conflictiva y renombrada
    Route::get('canalizaciones/{canalizacion}', [CanalizacionController::class, 'show'])->name('canalizaciones.show');
    Route::get('canalizaciones/{canalizacion}/formato', [CanalizacionController::class, 'showFormato'])->name('canalizaciones.formato.show');
    Route::post('canalizaciones/{canalizacion}/formato', [CanalizacionController::class, 'storeFormato'])->name('canalizaciones.formato.store');
    Route::post('/canalizaciones/{canalizacion}/seguimiento', [CanalizacionController::class, 'storeSeguimiento'])->name('canalizaciones.seguimiento.store');
    Route::get('/alumnos/{alumno}/historial', [CanalizacionController::class, 'showHistorial'])->name('alumnos.historial');
    Route::post('/alumnos/{alumno}/baja', [CanalizacionController::class, 'darDeBaja'])->name('alumnos.baja');
    Route::get('/reportes/canalizaciones-final', [CanalizacionController::class, 'exportarInformeFinalPlantilla'])->name('canalizaciones.reporte.final');
    Route::get('/canalizaciones/{canalizacion}/pdf', [CanalizacionController::class, 'exportarFormatoPDF'])->name('canalizaciones.formato.pdf');

    // --- Módulo: Estadías ---
    Route::get('estadias', function () {
        // Optimizado para cargar solo las relaciones necesarias y ordenar
        $alumnos = Alumno::with('opcionesEstadia.empresa')->orderBy('apellido_paterno')->get();
        $empresas = Empresa::where('estatus', 'Activa')->orderBy('nombre')->get();

        return view('layouts.estadias', [
            'alumnos' => $alumnos,
            'empresas' => $empresas
        ]);
    })->name('estadias');

    Route::put('/alumnos/{alumno}/opciones', function (Request $request, Alumno $alumno) {
        $validated = $request->validate([
            'opcion_1_id' => 'nullable|integer|exists:empresa,pk_empresa',
            'opcion_2_id' => 'nullable|integer|exists:empresa,pk_empresa',
            'opcion_3_id' => 'nullable|integer|exists:empresa,pk_empresa',
        ]);

        // Limpiar valores vacíos para que sean NULL (mejora de tu archivo 2)
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

    Route::patch('/opciones-estadia/{opcion}/status', function (Request $request, OpcionEstadia $opcion) {
        $validated = $request->validate([
            'estatus' => 'required|string|in:Pendiente,Contactado,No Contactado,Aceptado,Rechazado'
        ]);

        $opcion->update([
            'estatus' => $validated['estatus']
        ]);

        return response()->json(['success' => true, 'message' => 'Estatus actualizado.']);
    })->name('opciones-estadia.updateStatus');

    // --- Módulo: Estadías - Reportes y Finalización ---
    Route::get('estadias/reporte', [ReporteEstadiaController::class, 'index'])->name('estadias.reporte');
    Route::get('/estadias/reporte-final', [ReporteEstadiaController::class, 'finales'])->name('estadias.reporte.final');
    Route::patch('/alumnos/{alumno}/confirmar-final', [ReporteEstadiaController::class, 'confirmarFinal'])->name('alumnos.confirmarFinal');

    Route::patch('/alumnos/{alumno}/revertir-final', function (Alumno $alumno) {
        $opcionAceptada = $alumno->opcionesEstadia()
            ->where('estatus', 'Aceptado')
            ->first();

        if (!$opcionAceptada) {
            return response()->json(['success' => false, 'message' => 'Error: No se encontró la opción aceptada para revertir.'], 422);
        }

        $alumno->opcionesEstadia()
            ->where('pk_opcion_estadia', '!=', $opcionAceptada->pk_opcion_estadia)
            ->where('estatus', 'Rechazado')
            ->update(['estatus' => 'Pendiente']);

        return response()->json([
            'success' => true,
            'message' => '¡Reversión exitosa! El alumno está de vuelta en gestión.'
        ]);
    })->name('alumnos.revertirFinal');

    Route::get('estadias/reporte/pdf', function () {
        return "Página de descarga de PDF (aún no implementada)";
    })->name('estadias.reporte.pdf');


    // --- Módulo: Empresas (Relacionado con Estadías) ---
    Route::view('empresas/crear', 'layouts.nueva_empresa')->name('empresas.create');

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

    Route::put('/empresas/{empresa}', [EmpresaController::class, 'update'])->name('empresas.update');
    Route::delete('/empresas/{empresa}', [EmpresaController::class, 'destroy'])->name('empresas.destroy');


    // --- Módulo: Configuración de Usuario (Perfil) ---
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


/*
|--------------------------------------------------------------------------
| Rutas de Autenticación
|--------------------------------------------------------------------------
|
| Incluye las rutas de login, registro, etc.
|
*/
require __DIR__ . '/auth.php';