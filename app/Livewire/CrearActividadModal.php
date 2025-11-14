<?php

namespace App\Livewire;

use App\Models\Actividad;
use App\Models\TipoActividad;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;

class CrearActividadModal extends Component
{
    public bool $showModal = false;
    public $nombre = '';
    public $fk_tipo_actividad = '';
    public $fecha = '';
    public $asistencia = '';

    protected $rules = [
        'nombre' => 'required|string|max:150',
        'fk_tipo_actividad' => 'required|integer',
        'fecha' => 'required|date',
        'asistencia' => 'required|integer',
    ];

    protected $messages = [
        'nombre.required' => 'El nombre de la actividad es obligatorio.',
        'fk_tipo_actividad.required' => 'El tipo de actividad es obligatorio.',
        'fecha.required' => 'La fecha es obligatoria.',
        'asistencia.required' => 'El número de asistentes es obligatorio.',
    ];

    #[On('open-create-modal')]
    public function open()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->nombre = '';
        $this->fk_tipo_actividad = '';
        $this->fecha = '';
        $this->asistencia = '';
        $this->resetValidation();
    }

    public function guardarActividad()
    {
        $this->validate();

        Actividad::create([
            'nombre' => $this->nombre,
            'fk_tipo_actividad' => $this->fk_tipo_actividad,
            'fecha' => $this->fecha,
            'asistencia' => $this->asistencia,
            'estatus' => 'Pendiente',
        ]);

        return redirect(request()->header('Referer'))->with('status', '¡Actividad registrada con éxito!');
    }

    public function render()
    {
        $tiposActividad = TipoActividad::all();
        return view('livewire.crear-actividad-modal', [
            'tiposActividad' => $tiposActividad
        ]);
    }
}
