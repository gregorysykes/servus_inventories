<?php

namespace App\Http\Livewire\Stocks;

use Livewire\Component;

class AddStock extends Component
{
    public $transactions;
    public function mount($transactions){
        $this->transactions = $transactions;
    }
    public function render()
    {
        return view('livewire.stocks.add-stock');
    }
}
