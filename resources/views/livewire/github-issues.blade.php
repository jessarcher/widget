<?php

use function Livewire\Volt\{computed, state};

state(['class']);

$names = [
    // 'jessarcher/dotfiles',
    'laravel/framework',
    // 'laravel/laravel',
    //'laravel/docs',
    'laravel/prompts',
    'laravel/vite-plugin',
    //'laravel/breeze',
    //'laravel/jetstream',
    'inertiajs/inertia',
    'inertiajs/inertia-laravel',
];

$baseUrl = config('services.github.url');
$token = config('services.github.token');

$repositories = computed(fn () => Cache::remember('github-stats', 600, fn () => collect($names)->map(fn ($name) => Http::withToken($token)->get($baseUrl.'repos/'.$name)->json())));

?>

<div class="grid grid-cols-[auto,max-content,max-content] gap-x-12 gap-y-4 {{ $class }}">
    @foreach ($this->repositories as $repository)
        <a href="{{ $repository['html_url'] }}" class="flex items-center gap-4">
            <div class="h-7 w-7 rounded bg-yellow-300 glow">
                <img src="{{ $repository['owner']['avatar_url'] }}" class="object-cover h-7 w-7 grayscale mix-blend-multiply" />
            </div>
            <h2 class="text-xl font-bebas glow-sm truncate">{{ $repository['name'] }}</h2>
        </a>

        <a href="{{ $repository['html_url'] }}/stargazers" class="flex items-center justify-between gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-6 w-6 stroke-yellow-300 glow-sm opacity-75">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <p class="text-2xl font-bebas glow-sm tabular-nums">{{ number_format($repository['watchers']) }}</p>
        </a>

        <a href="{{ $repository['html_url'] }}/issues" class="flex items-center justify-between gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-6 w-6 stroke-yellow-300 glow-sm opacity-75">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7.875 14.25l1.214 1.942a2.25 2.25 0 001.908 1.058h2.006c.776 0 1.497-.4 1.908-1.058l1.214-1.942M2.41 9h4.636a2.25 2.25 0 011.872 1.002l.164.246a2.25 2.25 0 001.872 1.002h2.092a2.25 2.25 0 001.872-1.002l.164-.246A2.25 2.25 0 0116.954 9h4.636M2.41 9a2.25 2.25 0 00-.16.832V12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 12V9.832c0-.287-.055-.57-.16-.832M2.41 9a2.25 2.25 0 01.382-.632l3.285-3.832a2.25 2.25 0 011.708-.786h8.43c.657 0 1.281.287 1.709.786l3.284 3.832c.163.19.291.404.382.632M4.5 20.25h15A2.25 2.25 0 0021.75 18v-2.625c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125V18a2.25 2.25 0 002.25 2.25z" />
            </svg>
            <p class="text-2xl font-bebas glow-sm tabular-nums">{{ number_format($repository['open_issues_count']) }}</p>
        </a>
    @endforeach
</div>
