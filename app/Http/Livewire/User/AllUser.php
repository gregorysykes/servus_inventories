<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class AllUser extends Component
{
    public $users;
    public function mount($users){
        $this->users = $users;
    }
    public function render()
    {
        return view('livewire.user.all-user');
    }
}
