<?php

use function Livewire\Volt\{computed, state};

state('class');

$date = computed(fn () => now()->tz('Australia/Brisbane'));

?>

<div wire:poll.1s class="{{ $class }}text-right relative">
    <p class="invisible font-orbitron text-10xl leading-none">88:88</p>
    <p class="invisible font-orbitron text-5xl uppercase leading-none">Foo</p>

    <div class="absolute top-0 right-0">
        <p class="font-orbitron text-10xl leading-none glow">{{ $this->date->format('H') }}<span class="animate-flash">:</span>{{ $this->date->format('i') }}</p>
        <p class="font-orbitron text-5xl uppercase leading-none glow">{{ $this->date->format('D d M') }}</p>
    </div>
</div>
