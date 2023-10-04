<?php

use function Livewire\Volt\{computed, state};

state('class');

$percentage = computed(fn () => (int) `upower -i /org/freedesktop/UPower/devices/battery_BAT0 | grep percentage | awk '{print $2}'`);
$bars = computed(fn () => (int) round($this->percentage / 100 * 5));
$charging = computed(fn () => trim(`upower -i /org/freedesktop/UPower/devices/battery_BAT0 | grep state | awk '{print $2}'`) === 'charging');

?>

<div wire:poll.1s class="flex items-center gap-4 {{ $this->class }}">
    <div class="flex items-center gap-2">
        @if ($this->charging)
            <!-- bolt -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 stroke-[#fdef7e] [filter:drop-shadow(0_0_3px_#fdef7e)]">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
            </svg>
        @else
            <!-- bolt-slash -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 stroke-[#fdef7e] [filter:drop-shadow(0_0_3px_#fdef7e)]">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.412 15.655L9.75 21.75l3.745-4.012M9.257 13.5H3.75l2.659-2.849m2.048-2.194L14.25 2.25 12 10.5h8.25l-4.707 5.043M8.457 8.457L3 3m5.457 5.457l7.086 7.086m0 0L21 21" />
            </svg>
        @endif

        <p class="text-3xl font-bebas [filter:drop-shadow(0_0_3px_#fdef7e)]">
            {{ $this->percentage }}%
        </p>
    </div>

    <div class="flex w-fit gap-1 rounded border-[3px] border-[#fdef7e] px-2 py-1 [box-shadow:0_0_6px_#fdef7e,_inset_0_0_6px_#fdef7e]">
        <div class="h-8 w-4 -skew-x-12 rounded-sm bg-[#fdef7e] {{ $this->bars >= 1 ? '[box-shadow:0_0_6px_#fdef7e]' : 'opacity-20 [box-shadow:0_0_2px_#fdef7e]' }} {{ $this->charging && $this->bars === 1 ? 'animate-[pulse_1s_cubic-bezier(0.4,_0,_0.6,_1)_infinite]' : '' }}"></div>
        <div class="h-8 w-4 -skew-x-12 rounded-sm bg-[#fdef7e] {{ $this->bars >= 2 ? '[box-shadow:0_0_6px_#fdef7e]' : 'opacity-20 [box-shadow:0_0_2px_#fdef7e]' }} {{ $this->charging && $this->bars === 2 ? 'animate-[pulse_1s_cubic-bezier(0.4,_0,_0.6,_1)_infinite]' : '' }}"></div>
        <div class="h-8 w-4 -skew-x-12 rounded-sm bg-[#fdef7e] {{ $this->bars >= 3 ? '[box-shadow:0_0_6px_#fdef7e]' : 'opacity-20 [box-shadow:0_0_2px_#fdef7e]' }} {{ $this->charging && $this->bars === 3 ? 'animate-[pulse_1s_cubic-bezier(0.4,_0,_0.6,_1)_infinite]' : '' }}"></div>
        <div class="h-8 w-4 -skew-x-12 rounded-sm bg-[#fdef7e] {{ $this->bars >= 4 ? '[box-shadow:0_0_6px_#fdef7e]' : 'opacity-20 [box-shadow:0_0_2px_#fdef7e]' }} {{ $this->charging && $this->bars === 4 ? 'animate-[pulse_1s_cubic-bezier(0.4,_0,_0.6,_1)_infinite]' : '' }}"></div>
        <div class="h-8 w-4 -skew-x-12 rounded-sm bg-[#fdef7e] {{ $this->bars >= 5 ? '[box-shadow:0_0_6px_#fdef7e]' : 'opacity-20 [box-shadow:0_0_2px_#fdef7e]' }} {{ $this->charging && $this->bars === 5 ? 'animate-[pulse_1s_cubic-bezier(0.4,_0,_0.6,_1)_infinite]' : '' }}"></div>
    </div>
</div>
