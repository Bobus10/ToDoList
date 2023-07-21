<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\DumpHandler;

class AddTodos extends Component
{
    public $item;

    public function mount(){
        $this->item = '';
    }
    public function addTodo(){
        Todo::create([
            'item' => $this->item,
            'complited' => 0,
        ]);
        $this->reset('item');

    }
    public function render()
    {
        return view('livewire.add-todos');
    }
}
