<?php

namespace App\Http\Livewire\Packaging;

use Livewire\Component;

class AddPackaging extends Component
{
    public $processes;
    public function mount($processes){
        $this->processes = $processes;
    }
    public function render()
    {
        return view('livewire.packaging.add-packaging');
    }
}
