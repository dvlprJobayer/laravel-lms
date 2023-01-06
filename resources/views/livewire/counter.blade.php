<div>
    <div class="text-center">
        <button class="text-xl" wire:click="increment('some value')">+</button>
        <h1 class="text-xl">{{ $count }}</h1>
        <button wire:click="decrement" class="text-xl">-</button>
    </div>
</div>