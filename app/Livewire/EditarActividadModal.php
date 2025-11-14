<?php

namespace App\Livewire;

use App\Models\Actividad;
use App\Models\TipoActividad;
use Livewire\Component;
use Livewire\Attributes\On;

class EditarActividadModal extends Component
{
    public bool $showModal = false;
    public Actividad $actividad;
    public $nombre = '';
    public $fk_tipo_actividad = '';
    public $fecha = '';
    public $asistencia = '';
    public $estatus = '';

    protected $rules = [
        'nombre' => 'required|string|max:150',
        'fk_tipo_actividad' => 'required|integer',
        'fecha' => 'required|date',
        'asistencia' => 'required|integer',
        'estatus' => 'required|string',
    ];

    protected $messages = [
        'nombre.required' => 'El nombre de la actividad es obligatorio.',
        'fk_tipo_actividad.required' => 'El tipo de actividad es obligatorio.',
        'fecha.required' => 'La fecha es obligatoria.',
        'asistencia.required' => 'El número de asistentes es obligatorio.',
        'estatus.required' => 'El estatus es obligatorio.',
    ];

    #[On('open-edit-modal')]
    public function open($id)
    {
        $this->actividad = Actividad::find($id[0]);
        $this->nombre = $this->actividad->nombre;
        $this->fk_tipo_actividad = $this->actividad->fk_tipo_actividad;
        $this->fecha = $this->actividad->fecha;
        $this->asistencia = $this->actividad->asistencia;
        $this->estatus = $this->actividad->estatus;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function actualizarActividad()
    {
        $this->validate();

        $this->actividad->update([
            'nombre' => $this->nombre,
            'fk_tipo_actividad' => $this->fk_tipo_actividad,
            'fecha' => $this->fecha,
            'asistencia' => $this->asistencia,
            'estatus' => $this->estatus,
        ]);

        return redirect(request()->header('Referer'))->with('status', '¡Actividad actualizada con éxito!');
    }

    public function render()
    {
        $tiposActividad = TipoActividad::all();
        return view('livewire.editar-actividad-modal', [
            'tiposActividad' => $tiposActividad
        ]);
    }
}
