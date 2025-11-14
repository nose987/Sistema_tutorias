<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\TipoActividad;
use Illuminate\Http\Request;
use App\Exports\ActividadesExport;
use Maatwebsite\Excel\Facades\Excel;

class ActividadController extends Controller
{
    public function index()
    {
        $actividades = Actividad::with('tipoActividad')->get();
        $total_actividades = $actividades->count();

        return view('actividades', [
            'actividades' => $actividades,
            'total_actividades' => $total_actividades,
        ]);
    }

    public function create()
    {
        $tipos = TipoActividad::all();
        return view('actividades.create', ['tipos' => $tipos]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'fk_tipo_actividad' => 'required|exists:tipo_actividad,pk_tipo_actividad',
            'fecha' => 'required|date',
            'asistencia' => 'required|integer|min:0|max:99999',
        ]);

        Actividad::create([
            'nombre' => $request->nombre,
            'fk_tipo_actividad' => $request->fk_tipo_actividad,
            'fecha' => $request->fecha,
            'asistencia' => $request->asistencia,
            'estatus' => 'Realizada', // O 'Pendiente' segun la logica de negocio
        ]);

        return redirect()->route('actividades')->with('status', 'Actividad creada con éxito.');
    }

    public function show(Actividad $actividad)
    {
        return view('actividades.show', ['actividad' => $actividad]);
    }

    public function edit(Actividad $actividad)
    {
        $tipos = TipoActividad::all();
        return view('actividades.edit', [
            'actividad' => $actividad,
            'tipos' => $tipos,
        ]);
    }

    public function update(Request $request, Actividad $actividad)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'fk_tipo_actividad' => 'required|exists:tipo_actividad,pk_tipo_actividad',
            'fecha' => 'required|date',
            'asistencia' => 'required|integer|min:0|max:99999',
        ]);

        $actividad->update([
            'nombre' => $request->nombre,
            'fk_tipo_actividad' => $request->fk_tipo_actividad,
            'fecha' => $request->fecha,
            'asistencia' => $request->asistencia,
        ]);

        return redirect()->route('actividades')->with('status', 'Actividad actualizada con éxito.');
    }

    public function generarReporte()
    {
        $fileName = 'Reporte_Actividades_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new ActividadesExport, $fileName);
    }


}