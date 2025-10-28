<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Setting;

class DashboardEncuestaController extends Controller
{
    public function index(Request $request)
    {
        $setting = Setting::where('key', 'alumnos_esperados')->first();
        $total_esperados = $setting ? (int)$setting->value : 0;

        $respuestas_recibidas = Alumno::count();

        $alumnos_faltantes = $total_esperados - $respuestas_recibidas;
        if ($alumnos_faltantes < 0) {
            $alumnos_faltantes = 0;
        }

        $showAll = $request->has('show') && $request->query('show') == 'all';

        if ($showAll) {
            $ultimos_alumnos = Alumno::orderBy('pk_alumno', 'desc')->get();
        } else {
            $ultimos_alumnos = Alumno::orderBy('pk_alumno', 'desc')->limit(5)->get();
        }

        return view('encuestas', [
            'total_esperados' => $total_esperados,
            'respuestas_recibidas' => $respuestas_recibidas,
            'alumnos_faltantes' => $alumnos_faltantes,
            'ultimos_alumnos' => $ultimos_alumnos,
            'showing_all' => $showAll,
        ]);
    }

    public function updateAlumnosEsperados(Request $request)
    {
        $request->validate([
            'alumnos_esperados' => 'required|integer|min:0',
        ]);

        Setting::updateOrCreate(
            ['key' => 'alumnos_esperados'],
            ['value' => $request->input('alumnos_esperados')]
        );

        return redirect()->route('encuestas')->with('success', 'El número de alumnos esperados se ha guardado.');
    }
}
