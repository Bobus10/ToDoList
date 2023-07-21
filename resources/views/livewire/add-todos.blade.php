<div>
    <input type="text" placeholder="Do or do not..." wire:model="item" wire:keydown.enter="addTodo">
    {{ $item }}
    @error('item')
        <span class="text-red-500 mt-2">{{ $message }}</span>
    @enderror
</div>
