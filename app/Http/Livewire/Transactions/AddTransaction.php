<?php

namespace App\Http\Livewire\Transactions;

use Livewire\Component;

class AddTransaction extends Component
{
    public $items;
    public function mount($items){ 
        $this->items = $items;
    }
    public function render()
    {
        return view('livewire.transactions.add-transaction');
    }
}
