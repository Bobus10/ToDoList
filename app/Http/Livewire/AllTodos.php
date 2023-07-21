<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Livewire\Component;

class AllTodos extends Component
{
    public $todos;

    public function mount(){
        $this->todos = Todo::latest()->get();
    }
    public function render()
    {
        return view('livewire.all-todos');
    }
}
