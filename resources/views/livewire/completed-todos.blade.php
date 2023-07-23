<div>
    <h2 class="text-xl font-semibold mt-4 px-4">Done:</h2>
    <div class="flex flex-col px-4 py-4 space-x-4 space-y-2">
        @foreach ($todos as $index => $todo)
            <div class="bg-gray-100 rounded p-2 mt-2 flex justify-between">
                <div>
                    @if ($editedTodoIndex === $index || $editedTodoField === $index.'.item')
                        <input type="text
                            @click.away="$wire.editedTodoField === '{{ $index }}.item' ? $wire.saveTodo({{ $index }}) : null"
                            @keydown.enter="$wire.saveTodo({{ $index }})"
                            wire:model.defer="todos.{{ $index }}.item"
                        />
                        @if ($errors->has('todos.'.$index.'.item'))
                            <div class="text-red-500">
                                {{ $errors->first('todos.'.$index.'.item') }}
                            </div>
                        @endif
                    @else
                        <p class="line-through cursor-pointer" wire:click="editTodoField({{ $index }}, 'item')">
                            {{ $todo['item'] }}
                        </p>
                    @endif
                </div>

                <div>
                    <button type="button" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 transition"
                        wire:click.prevent="incompleteTodo({{ $index }})">
                        Incomplete
                    </button>

                    <button type="button" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 transition"
                        wire:click.prevent="deleteTodo({{ $index }})">
                        Delete
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>

