<div>
    <h2 class="text-x1 font-semibold mt-4 px-4">To Do List:</h2>
    <div class="flex flex-col px-4 py-4 space-x-4">
        @foreach ($todos as $todo)
            <div class="flex justify-between">
                <div class="cursor-pointer">
                    {{ $todo->item }}
                </div>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-success">
                    complete
                </button>
                <button type="button" class="btn btn-danger">
                    delete
                </button>
            </div>
        @endforeach
    </div>
</div>
