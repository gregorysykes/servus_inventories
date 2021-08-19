<?php

namespace App\Http\Livewire\Process;

use Livewire\Component;

class AddProcess extends Component
{
    public $transactions;
    public function mount($transactions){
        return $this->transactions = $transactions;
    }
    public function render()
    {
        return view('livewire.process.add-process');
    }
}
