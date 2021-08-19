<?php

namespace App\Http\Livewire\State;

use Livewire\Component;

class AllState extends Component
{
    public $states;
    public function mount($states){
        $this->states = $states;
    }
    public function render()
    {
        return view('livewire.state.all-state');
    }
}
