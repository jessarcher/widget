<?php

use function Livewire\Volt\{state};

state('class');

?>

<div wire:poll.1s class="{{ $class }}">
  <p class="font-bebas text-7xl text-[#fdef7e] [filter:drop-shadow(0_0_3px_#fdef7e)]">{{ now()->tz('Australia/Brisbane')->format('H:i:s') }}</p>
  <p class="font-bebas text-3xl text-[#fdef7e] [filter:drop-shadow(0_0_3px_#fdef7e)]">{{ now()->tz('Australia/Brisbane')->format('D d M Y') }}</p>
</div>
