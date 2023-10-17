<?php

use function Livewire\Volt\{state};

state('class');

?>

<div wire:poll.1s class="{{ $class }}text-right">
    <p class="font-bebas text-10xl leading-none text-orange-400 glow">{{ now()->tz('Australia/Brisbane')->format('H.i') }}</p>
    <p class="font-bebas text-5xl leading-none text-orange-400 glow">{{ now()->tz('Australia/Brisbane')->format('D d M') }}</p>
</div>
