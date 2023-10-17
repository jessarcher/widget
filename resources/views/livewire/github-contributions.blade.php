<?php

use function Livewire\Volt\{computed, state};

state(['class', 'username']);

$svg = computed(fn () => Cache::remember('github-contributions', 86400, function () {
    $svg = file_get_contents("https://ghchart.rshah.org/{$this->username}");
    $svg = preg_replace('/^.*?<svg/s', '<svg', $svg);
    $svg = str_replace(' width="663" height="104"', ' viewBox="0 0 636 84" class="w-full"', $svg);
    $svg = preg_replace('/<text.*?<\/text>/', '', $svg);
    $svg = preg_replace_callback(
        '/([xy])="(\d+)"/',
        fn ($matches) => $matches[1] . '="' . ($matches[2] - ($matches[1] === 'x' ? 27 : 20)) . '" r' . $matches[1] . '="2"',
        $svg
        );
    $svg = str_replace('data-date', 'title', $svg);
    $svg = str_replace('shape-rendering:crispedges;', '', $svg);
    $svg = str_replace([
        '#196127',
        '#239a3b',
        '#7bc96f',
        '#c6e48b',
        '#eeeeee',
    ], [
        'rgba(253,239,126,1);filter:drop-shadow(0 0 2px rgba(253,239,126,1))',
        'rgba(253,239,126,0.75);filter:drop-shadow(0 0 2px rgba(253,239,126,0.75))',
        'rgba(253,239,126,0.5);filter:drop-shadow(0 0 2px rgba(253,239,126,0.5))',
        'rgba(253,239,126,0.25);filter:drop-shadow(0 0 2px rgba(253,239,126,0.25))',
        'rgba(253,239,126,0.1);filter:drop-shadow(0 0 2px rgba(253,239,126,0.1))',
    ], $svg);

    return $svg;
}));
?>

<div class="{{ $class }}" wire:poll.3600s>
    {!! $this->svg !!}
</div>
