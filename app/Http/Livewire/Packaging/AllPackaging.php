<?php

namespace App\Http\Livewire\Packaging;

use Livewire\Component;

class AllPackaging extends Component
{
    public $packagings;
    public function mount($packagings){
        $this->packagings = $packagings;
    }
    public function render()
    {
        return view('livewire.packaging.all-packaging');
    }
}
