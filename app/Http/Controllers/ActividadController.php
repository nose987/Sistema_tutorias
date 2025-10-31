<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\TipoActividad;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
        // Crear un nuevo objeto Spreadsheet en lugar de usar una plantilla
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Reporte de Actividades');

        // Definir encabezados
        $headers = [
            'ID',
            'Nombre',
            'Tipo de Actividad',
            'Fecha',
            'Asistentes',
            'Estatus'
        ];

        // Agregar encabezados al archivo
        for ($i = 0; $i < count($headers); $i++) {
            $sheet->setCellValueByColumnAndRow($i + 1, 1, $headers[$i]);
        }

        // Establecer negrita para los encabezados
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);

        // Obtener las actividades con su tipo
        $actividades = Actividad::with('tipoActividad')->get();

        // Agregar datos de las actividades
        $row = 2; // Comenzar en la fila 2 después de los encabezados
        foreach ($actividades as $actividad) {
            $sheet->setCellValueByColumnAndRow(1, $row, $actividad->pk_actividad);
            $sheet->setCellValueByColumnAndRow(2, $row, $actividad->nombre);
            $sheet->setCellValueByColumnAndRow(3, $row, $actividad->tipoActividad->nombre ?? 'N/A');
            $sheet->setCellValueByColumnAndRow(4, $row, Carbon::parse($actividad->fecha)->format('d/m/Y'));
            $sheet->setCellValueByColumnAndRow(5, $row, $actividad->asistencia);
            $sheet->setCellValueByColumnAndRow(6, $row, $actividad->estatus);

            $row++;
        }

        // Ajustar ancho de columnas
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);

        $fileName = 'Reporte_Actividades_' . date('Y-m-d_H-i-s') . '.xlsx';

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        $response = new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        });

        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $fileName . '"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }


}