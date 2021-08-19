<?php

namespace App\Http\Livewire\Items;

use Livewire\Component;

class AllItems extends Component
{
    public $items;

    public function mount($items){ 
        $this->items = $items;
    }

    public function render()
    {
        return view('livewire.items.all-items');
    }
}
