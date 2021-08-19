<?php

namespace App\Http\Livewire\Stocks;

use Livewire\Component;

class AllStocks extends Component
{
    public $states;
    public $processes;
    public $teams;
    public function mount($states, $processes, $teams){
        $this->states = $states;
        $this->processes = $processes;
        $this->teams = $teams;
    }
    public function render()
    {
        return view('livewire.stocks.all-stocks');
    }
}
