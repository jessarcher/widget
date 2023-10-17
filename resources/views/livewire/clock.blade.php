<?php

use function Livewire\Volt\{state};

state('class');

?>

<div wire:poll.1s class="{{ $class }}">
    <p class="font-bebas text-8xl glow">{{ now()->tz('Australia/Brisbane')->format('H:i:s') }}</p>
    <p class="font-bebas text-3xl glow">{{ now()->tz('Australia/Brisbane')->format('D d M Y') }}</p>
</div>
