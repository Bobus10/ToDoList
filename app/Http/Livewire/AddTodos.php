<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\DumpHandler;

class AddTodos extends Component
{
    public $item;

    protected $rules = [
        'item' => 'required|min:4',
    ];

    protected $validationAttributes = [
        'item' => 'to-do'
    ];

    public function updated ($propertyName){
        $this->validateOnly($propertyName);
    }

    public function mount(){
        $this->item = '';
    }
    public function addTodo(){
        $validatedData = $this->validate();
        Todo::create($validatedData);
        $this->reset('item');
        $this->emit('todoAdded');
    }
    public function render()
    {
        return view('livewire.add-todos');
    }
}
