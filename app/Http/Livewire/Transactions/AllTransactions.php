<?php

namespace App\Http\Livewire\Transactions;

use Livewire\Component;

class AllTransactions extends Component
{
    public $transactions;
    public function mount($transactions){
        $this->transactions = $transactions;
    }
    public function render()
    {
        return view('livewire.transactions.all-transactions');
    }
}
