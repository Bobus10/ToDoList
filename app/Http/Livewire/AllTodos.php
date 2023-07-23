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
        $this->validate();
        $todo = $this->todos[$todoIndex] ?? NULL;
        if ($todo) {
            $todoId = Todo::find($todo['id']);
            if ($todoId) {
                $todoId->item = $todo['item'];
                $todoId->save();
            }
        }
        $this->editedTodoField = null;
        $this->editedTodoIndex = null;
    }

    public function deleteTodo($todoIndex){
        $todo = $this->todos[$todoIndex];
        Todo::find($todo['id'])->delete();
        $this->todos = Todo::latest()->get()->toArray();
    }

    public function completeTodo($todoIndex){
        $todo = $this->todos[$todoIndex];
        Todo::find($todo['id'])->update(['complited' => 1]);
        $this->todos = Todo::latest()->get()->toArray();
    }

    public function render()
    {
        return view('livewire.all-todos', [
            'todos' => $this->todos,
        ]);
    }
}
