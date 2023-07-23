<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Livewire\Component;

class AllTodos extends Component
{
    public $todos = [];
    public $editedTodoIndex = null;
    public $editedTodoField = null;

    protected $listeners = ['todoAdded'];

    public function todoAdded(){
        $this->todos = Todo::latest()->get();
    }

    public function editTodo($todoIndex){
        $this->editedTodoIndex = $todoIndex;
    }

    public function editTodoField($todoIndex, $fieldName){
        $this->editedTodoField = $todoIndex.'.'.$fieldName;
    }

    public function saveTodo($todoIndex){
        $todo = $this->todos[$todoIndex] ?? NULL;
        if(!is_null($todo)){
            optional(Todo::find($todo['id']))->update($todo);
        }
        $this->editedTodoField = null;
        $this->editedTodoIndex = null;
    }

    public function mount(){
        $this->todos = Todo::latest()->get()->toArray();
    }
    public function render()
    {
        return view('livewire.all-todos', [
            'todos' => $this->todos,
        ]);
    }
}
