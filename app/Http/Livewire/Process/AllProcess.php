<?php

namespace App\Http\Livewire\Process;

use Livewire\Component;

class AllProcess extends Component
{
    public $processes;
    public function mount($processes){
        return $this->processes = $processes;
    }
    public function render()
    {
        return view('livewire.process.all-process');
    }
}
