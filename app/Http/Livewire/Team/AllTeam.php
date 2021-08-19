<?php

namespace App\Http\Livewire\Team;

use Livewire\Component;

class AllTeam extends Component
{
    public $teams;
    public function mount($teams){
        $this->teams = $teams;
    }
    public function render()
    {
        return view('livewire.team.all-team');
    }
}
