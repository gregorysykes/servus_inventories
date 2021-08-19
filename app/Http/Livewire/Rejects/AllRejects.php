<?php

namespace App\Http\Livewire\Rejects;

use Livewire\Component;

class AllRejects extends Component
{
    public $rejects;
    public $states;
    public function mount($rejects,$states){
        $this->rejects = $rejects;
        $this->states = $states;
    }
    public function render()
    {
        return view('livewire.rejects.all-rejects');
    }
}
