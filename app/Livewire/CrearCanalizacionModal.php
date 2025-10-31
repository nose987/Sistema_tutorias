<?php

namespace App\Livewire;

// --- IMPORTACIONES NUEVAS ---
use App\Models\Canalizacion; // Importa el modelo que acabas de crear
use Carbon\Carbon;           // Para manejar la fecha

// ... (otras importaciones)
use App\Models\MotivoCanalizacion;
use App\Models\Alumno;
use App\Models\Grupo;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;


class CrearCanalizacionModal extends Component
{
    // ... (propiedades existentes: $showModal, $motivos, $search, etc.)
    public bool $showModal = false;
    public $motivos = [];
    public $search = '';
    public $selectedMotivoId = '';
    public $selectedAlumno = null;
    public $selectedAlumnoId = null;


    // --- 1. AÑADE LAS REGLAS DE VALIDACIÓN ---
    protected $rules = [
        'selectedAlumnoId' => 'required',
        'selectedMotivoId' => 'required',
    ];

    // --- 2. AÑADE LOS MENSAJES DE ERROR PERSONALIZADOS ---
    protected $messages = [
        'selectedAlumnoId.required' => 'Debes seleccionar un alumno.',
        'selectedMotivoId.required' => 'Debes seleccionar un motivo.',
    ];
    
    // ... (tus métodos existentes: mount, open, closeModal, resetForm, updatedSearch, getAlumnosResult, selectAlumno)
    public function mount()
    {
        $this->motivos = MotivoCanalizacion::all();
    }

    #[On('open-modal')]
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
        $this->search = '';
        $this->selectedMotivoId = '';
        $this->selectedAlumno = null;
        $this->selectedAlumnoId = null;
        $this->resetValidation(); // Limpia los errores de validación
    }
    
    public function updatedSearch($value)
    {
        if ($this->selectedAlumno) {
            $nombreCompleto = "{$this->selectedAlumno->nombre} {$this->selectedAlumno->apellido_paterno} {$this->selectedAlumno->apellido_materno}";
            if ($value !== $nombreCompleto) {
                $this->selectedAlumno = null;
                $this->selectedAlumnoId = null;
            }
        }
    }
    
    #[Computed]
    public function getAlumnosResult()
    {
        if ($this->selectedAlumno) {
            return [];
        }
        if (strlen($this->search) < 2) {
            return [];
        }
        return Alumno::select(
                'alumno.pk_alumno',
                'alumno.nombre',
                'alumno.apellido_paterno',
                'alumno.apellido_materno',
                'alumno.fecha_nacimiento',
                'grupo.nombre_grupo'
            )
            ->join('grupo', 'alumno.fk_grupo', '=', 'grupo.pk_grupo')
            ->where('alumno.estatus', 'Activo')
            ->where(function ($query) {
                $query->where(DB::raw("CONCAT(alumno.nombre, ' ', apellido_paterno, ' ', apellido_materno)"), 'LIKE', "%{$this->search}%")
                      ->orWhere('pk_alumno', 'LIKE', "%{$this->search}%");
            })
            ->limit(5)
            ->get()
            ->map(function ($alumno) {
                $alumno->edad = Carbon::parse($alumno->fecha_nacimiento)->age;
                return $alumno;
            });
    }

    public function selectAlumno($id)
    {
        $alumno = Alumno::select(
                'alumno.pk_alumno',
                'alumno.nombre',
                'alumno.apellido_paterno',
                'alumno.apellido_materno',
                'alumno.fecha_nacimiento',
                'grupo.nombre_grupo'
            )
            ->join('grupo', 'alumno.fk_grupo', '=', 'grupo.pk_grupo')
            ->where('pk_alumno', $id)
            ->first();

        if ($alumno) {
            $alumno->edad = Carbon::parse($alumno->fecha_nacimiento)->age;
            $nombreCompleto = "{$alumno->nombre} {$alumno->apellido_paterno} {$alumno->apellido_materno}";

            $this->selectedAlumno = $alumno;
            $this->selectedAlumnoId = $alumno->pk_alumno;
            $this->search = $nombreCompleto;
            $this->resetValidation('selectedAlumnoId'); // Borra el error si lo había
        }
    }


    // --- 3. AÑADE EL MÉTODO PARA GUARDAR ---
    public function guardarCanalizacion()
    {
        // Primero, valida los datos
        $this->validate();

        // Si la validación pasa, crea el registro
        Canalizacion::create([
            'fk_alumno' => $this->selectedAlumnoId,
            'fk_motivo_canalizacion' => $this->selectedMotivoId,
            'fecha_inicio' => Carbon::now(), // Pone la fecha y hora actual
            'estatus' => 'Activa' //
        ]);

        // Recarga la página actual y envía un mensaje de éxito
        return redirect(request()->header('Referer'))
            ->with('status', '¡Canalización registrada con éxito!');
    }

    // ... (tu método render() existente)
    public function render()
    {
        return view('livewire.crear-canalizacion-modal', [
            'alumnosResult' => $this->getAlumnosResult()
        ]);
    }
}