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

    protected $rules = [
        'todos.*.item' => 'required|min:4'
    ];

    protected $validationAttributes = [
        'todos.*.item' => 'to-do',
    ];

    public function mount(){
        $this->todos = Todo::latest()->get()->toArray();
    }

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
        // $this->validate(); //dont save changes
        $todo = $this->todos[$todoIndex] ?? NULL;
        if(!is_Null($todo)) {
            optional(Todo::find($todo['id']))->update($todo);
        }
        $this->editedTodoField = null;
        $this->editedTodoIndex = null;
    }

    public function render()
    {
        return view('livewire.all-todos', [
            'todos' => $this->todos,
        ]);
    }
}
