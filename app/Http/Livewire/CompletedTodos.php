<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Livewire\Component;

class CompletedTodos extends Component
{
    public $todos = [];
    public $editedTodoIndex = null;
    public $editedTodoField = null;

    protected $listeners = ['todoCompleted'];

    protected $rules = [
        'todos.*.item' => 'required|min:4'
    ];

    protected $validationAttributes = [
        'todos.*.item' => 'to-do',
    ];

    public function mount(){
        $this->todos = Todo::where('complited', 1)->latest()->get()->toArray();
    }

    public function todoCompleted(){
        $this->todos = Todo::where('complited', 1)->latest()->get()->toArray();
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
        $this->todos = Todo::where('complited', 1)->latest()->get()->toArray();
    }

    public function incompleteTodo($todoIndex){
        $todo = $this->todos[$todoIndex];
        Todo::find($todo['id'])->update(['complited' => 0]);
        $this->todos = Todo::where('complited', 1)->latest()->get()->toArray();
        $this->emit('todoIncompleted');
    }

    public function render()
    {
        return view('livewire.completed-todos', [
            'todos' => $this->todos,
        ]);
    }
}
