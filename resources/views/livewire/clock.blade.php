<?php

use function Livewire\Volt\{computed, state};

state('class');

$date = computed(fn () => now()->tz('Australia/Brisbane'));

?>

<div wire:poll.1s class="{{ $class }}text-right">
    <p class="font-orbitron text-10xl leading-none text-orange-400 glow">{{ $this->date->format('H') }}<span class="animate-flash">:</span>{{ $this->date->format('i') }}</p>
    <p class="font-orbitron text-5xl uppercase leading-none text-orange-400 glow">{{ $this->date->format('D d M') }}</p>
</div>
