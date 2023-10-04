<?php

use function Livewire\Volt\{computed, state};

state('class');

$volume = computed(fn () => (int) trim(`amixer sget Master | awk -F"[][]" '/Left:/ { print $2 }'`));
$muted = computed(fn () => trim(`amixer sget Master | awk -F"[][]" '/Left:/ { print $4 }'`) === 'off');

$updateVolume = fn ($value) => trim(`amixer sset Master {$value}%`);
$toggleMute = fn () => trim(`amixer sset Master toggle`);

?>

<div wire:poll.1s class="{{ $class }}">
    <div class="flex justify-between items-center">
        <p class="text-3xl font-bebas [filter:drop-shadow(0_0_3px_#fdef7e)]">
            {{ $this->volume }}%
        </p>

        <button wire:click="toggleMute">
            @if ($this->muted)
                <!-- speaker-x-mark -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-7 w-7 stroke-[#fdef7e] [filter:drop-shadow(0_0_3px_#fdef7e)]">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 9.75L19.5 12m0 0l2.25 2.25M19.5 12l2.25-2.25M19.5 12l-2.25 2.25m-10.5-6l4.72-4.72a.75.75 0 011.28.531V19.94a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.506-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.395C2.806 8.757 3.63 8.25 4.51 8.25H6.75z" />
                </svg>
            @else
                <!-- speaker-wave -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-7 w-7 stroke-[#fdef7e] [filter:drop-shadow(0_0_3px_#fdef7e)]">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z" />
                </svg>
            @endif
        </button>
    </div>

    <input
        type="range"
        min="0"
        max="100"
        value="{{ $this->volume }}"
        wire:change="updateVolume($event.target.value)"
        class="w-full bg-transparent [filter:drop-shadow(0_0_3px_#fdef7e)] [&::-moz-range-thumb]:opacity-0 [&::-moz-range-progress]:bg-[#fdef7e] [&::-moz-range-progress]:rounded-full [&::-moz-range-track]:bg-[#fdef7e] [&::-moz-range-track]:opacity-20 [&::-moz-range-track]:rounded-full"
    />
</div>
