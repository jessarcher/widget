<?php

use function Livewire\Volt\{computed, state};

state('class');

$percentage = computed(fn () => (int) `upower -i /org/freedesktop/UPower/devices/battery_BAT0 | grep percentage | awk '{print $2}'`);
$bars = computed(fn () => number_format($this->percentage / 100 * 5, 2));
$charging = computed(fn () => trim(`upower -i /org/freedesktop/UPower/devices/battery_BAT0 | grep state | awk '{print $2}'`) === 'charging');

?>

<div wire:poll.1s class="flex items-center gap-6 {{ $this->class }}">
    <div class="flex items-center gap-2">
        @if ($this->charging)
            <!-- bolt -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 stroke-yellow-300 glow">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
            </svg>
        @else
            <!-- bolt-slash -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 stroke-yellow-300 glow">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.412 15.655L9.75 21.75l3.745-4.012M9.257 13.5H3.75l2.659-2.849m2.048-2.194L14.25 2.25 12 10.5h8.25l-4.707 5.043M8.457 8.457L3 3m5.457 5.457l7.086 7.086m0 0L21 21" />
            </svg>
        @endif

        <p class="text-5xl font-bebas glow">
            {{ $this->percentage }}%
        </p>
    </div>

    <div class="flex-1 flex w-fit gap-1 rounded border-[3px] border-yellow-300 px-2 py-1 glow-inset">
        @for ($i = 0; $i < 5; $i++)
            @php
                $barPercent = min($this->bars - $i, 1);
                $opacity = max(0.2, $barPercent * 0.8 + 0.2);
            @endphp
            <div class="h-10 w-1/5 -skew-x-12 rounded-sm bg-yellow-300 {{ $barPercent > 0 ? '[box-shadow:0_0_6px_#fdef7e]' : '[box-shadow:0_0_2px_#fdef7e]' }} {{ $this->charging && $barPercent >= 0 && $barPercent < 1 ? 'animate-pulse-up' : '' }}" style="opacity: {{ $opacity }}; --opacity-max: {{ min(1, $opacity * 2) }}; --opacity-min: {{ max($opacity * 0.6, 0.2) }}"></div>
        @endfor
    </div>
</div>
