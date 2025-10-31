<?php

namespace App\Livewire;

use App\Models\Actividad;
use Livewire\Component;
use Livewire\Attributes\On;

class VerActividadModal extends Component
{
    public bool $showModal = false;
    public Actividad $actividad;

    #[On('open-view-modal')]
    public function open($id)
    {
        $this->actividad = Actividad::find($id[0]);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.ver-actividad-modal');
    }
}
