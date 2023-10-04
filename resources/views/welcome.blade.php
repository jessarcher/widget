<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Pixelify+Sans&family=Press+Start+2P&family=Teko&family=Wavefont&display=swap" rel="stylesheet">

        <!-- Styles -->
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased bg-[#1d0f02] p-10 text-[#fdef7e]">
        <div class="grid gap-10 grid-cols-2 max-w-2xl items-center">
            <livewire:clock />
            <div class="flex flex-col items-end gap-6">
                <livewire:battery />
                <livewire:volume />
            </div>
            <livewire:media-player class="col-span-2" />
        </div>
    </body>
</html>
