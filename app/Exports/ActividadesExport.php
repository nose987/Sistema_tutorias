<?php

namespace App\Exports;

use App\Models\Actividad;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class ActividadesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Actividad::with('tipoActividad')->get();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Tipo de Actividad',
            'Fecha',
            'Asistentes',
            'Estatus',
        ];
    }

    /**
    * @param mixed $actividad
    * @return array
    */
    public function map($actividad): array
    {
        return [
            $actividad->pk_actividad,
            $actividad->nombre,
            $actividad->tipoActividad->nombre ?? 'N/A',
            Carbon::parse($actividad->fecha)->format('d/m/Y'),
            $actividad->asistencia,
            $actividad->estatus,
        ];
    }
}
