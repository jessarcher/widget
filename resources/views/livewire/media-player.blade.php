<?php

use function Livewire\Volt\{computed, state};

state(['class']);

$status = computed(fn () => trim(`playerctl status`));

$meta = computed(function () {
    $meta = explode('%%', trim(`playerctl metadata --format {{xesam:title}}%%{{xesam:artist}}%%{{mpris:artUrl}}`));

    return [
        'title' => $meta[0] ?? null,
        'artist' => $meta[1] ?? null,
        'url' => ! empty($meta[2]) ? base64_encode(file_get_contents(trim($meta[2]))) : null,
    ];
});

$play = fn () => `playerctl play-pause`;
$next = fn () => `playerctl next`;
$previous = fn () => `playerctl previous`;

?>

<div wire:poll.1s class="flex justify-between rounded-lg bg-yellow-950/40 p-6 relative {{ $class }}" }}>
  <div class="flex flex-1 items-center w-full">
    <div class="flex-shrink-0 h-36 w-36 overflow-hidden rounded bg-[#fdef7e] [box-shadow:0_0_6px_#fdef7e] flex items-center justify-center">
      @if ($this->meta['url'])
        <img
          class="object-cover h-36 w-36 mix-blend-color-burn grayscale hover:mix-blend-normal hover:grayscale-0"
          src="data:image/jpeg;base64,{{ $this->meta['url'] }}"
        />
      @else
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-20 h-20 stroke-[#1d0f02] glow">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 9l10.5-3m0 6.553v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 11-.99-3.467l2.31-.66a2.25 2.25 0 001.632-2.163zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 01-.99-3.467l2.31-.66A2.25 2.25 0 009 15.553z" />
        </svg>
      @endif
    </div>
    <div class="ml-6 flex-1 overflow-hidden">
        <div class="flex">
            <div class="flex-1 overflow-hidden relative">
                <p class="font-bebas text-4xl glow truncate">{{ $this->meta['title'] }}&nbsp;</p>
                <p class="font-bebas text-2xl opacity-75 glow truncate">{{ $this->meta['artist'] }}&nbsp;</p>
                <div class="absolute top-0 right-0 bottom-0 w-5 bg-gradient-to-r from-transparent to-[#2c1704]"></div>
            </div>
            <div class="flex-shrink-0 h-10 flex items-center gap-1">
                <div class="{{ $this->status === 'Playing' ? 'animate-wave scale-y-50' : 'opacity-50 scale-y-[.1]' }} h-full w-0.5 transition [animation-delay:_0s] rounded-full  bg-[#fdef7e] glow"></div>
                <div class="{{ $this->status === 'Playing' ? 'animate-wave scale-y-100' : 'opacity-50 scale-y-[.1]' }} h-full w-0.5 transition [animation-delay:_0.05s] rounded-full bg-[#fdef7e] glow"></div>
                <div class="{{ $this->status === 'Playing' ? 'animate-wave scale-y-75' : 'opacity-50 scale-y-[.1]' }} h-full w-0.5 transition [animation-delay:_0.10s] rounded-full bg-[#fdef7e] glow"></div>
                <div class="{{ $this->status === 'Playing' ? 'animate-wave scale-y-90' : 'opacity-50 scale-y-[.1]' }} h-full w-0.5 transition [animation-delay:_0.15s] rounded-full bg-[#fdef7e] glow"></div>
                <div class="{{ $this->status === 'Playing' ? 'animate-wave scale-y-50' : 'opacity-50 scale-y-[.1]' }} h-full w-0.5 transition [animation-delay:_0.20s] rounded-full bg-[#fdef7e] glow"></div>
            </div>
        </div>

        <div class="flex-1 flex flex-col items-center">
            <div class="flex items-center gap-4">
                <!-- backward -->
                <button wire:click="previous">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-10 w-10 stroke-yellow-300 glow">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 16.811c0 .864-.933 1.405-1.683.977l-7.108-4.062a1.125 1.125 0 010-1.953l7.108-4.062A1.125 1.125 0 0121 8.688v8.123zM11.25 16.811c0 .864-.933 1.405-1.683.977l-7.108-4.062a1.125 1.125 0 010-1.953L9.567 7.71a1.125 1.125 0 011.683.977v8.123z" />
                    </svg>
                </button>

                <button wire:click="play">
                    @if ($this->status === 'Playing')
                        <!-- pause -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-14 w-14 stroke-yellow-300 glow">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25v13.5m-7.5-13.5v13.5" />
                        </svg>
                    @else
                        <!-- play -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-14 w-14 stroke-yellow-300 glow">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                        </svg>
                    @endif
                </button>

                <!-- forward -->
                <button wire:click="next">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-10 w-10 stroke-yellow-300 glow">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8.688c0-.864.933-1.405 1.683-.977l7.108 4.062a1.125 1.125 0 010 1.953l-7.108 4.062A1.125 1.125 0 013 16.81V8.688zM12.75 8.688c0-.864.933-1.405 1.683-.977l7.108 4.062a1.125 1.125 0 010 1.953l-7.108 4.062a1.125 1.125 0 01-1.683-.977V8.688z" />
                    </svg>
                </button>
            </div>
        {{-- <div class="mt-4 w-full flex items-center gap-4"> --}}
        {{--   <div class="flex gap-1"> --}}
        {{--     <!-- 0 --> --}}
        {{--     <svg viewBox="0 0 52 76" class="h-4 w-3 fill-[#fdef7e] glow" xmlns="http://www.w3.org/2000/svg"> --}}
        {{--       <path d="M37.5 0H14.5L9.5 5L14.5 10H37.5L42.5 5L37.5 0Z" /> --}}
        {{--       <path d="M10 28.5L10 14.5L5 9.5L-2.18557e-07 14.5L-8.30516e-07 28.5L5 33.5L10 28.5Z" /> --}}
        {{--       <path d="M52 28.5L52 14.5L47 9.5L42 14.5L42 28.5L47 33.5L52 28.5Z" /> --}}
        {{--       <path d="M37.5 33H14.5L9.5 38L14.5 43H37.5L42.5 38L37.5 33Z" class="opacity-10" /> --}}
        {{--       <path d="M10 61.5L10 47.5L5 42.5L-2.18557e-07 47.5L-8.30516e-07 61.5L5 66.5L10 61.5Z" /> --}}
        {{--       <path d="M52 61.5L52 47.5L47 42.5L42 47.5L42 61.5L47 66.5L52 61.5Z" /> --}}
        {{--       <path d="M37.5 66H14.5L9.5 71L14.5 76H37.5L42.5 71L37.5 66Z" /> --}}
        {{--     </svg> --}}
        {{--     <!-- : --> --}}
        {{--     <svg viewBox="0 0 10 76" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-4 w-1 fill-[#fdef7e] glow"> --}}
        {{--       <path d="M5 26.5L10 21.5L5 16.5L-2.18557e-07 21.5L5 26.5Z" /> --}}
        {{--       <path d="M5 59.5L10 54.5L5 49.5L-2.18557e-07 54.5L5 59.5Z" /> --}}
        {{--     </svg> --}}
        {{--     <!-- 2 --> --}}
        {{--     <svg viewBox="0 0 52 76" class="h-4 w-3 fill-[#fdef7e] glow" xmlns="http://www.w3.org/2000/svg"> --}}
        {{--       <path d="M37.5 0H14.5L9.5 5L14.5 10H37.5L42.5 5L37.5 0Z" /> --}}
        {{--       <path d="M10 28.5L10 14.5L5 9.5L-2.18557e-07 14.5L-8.30516e-07 28.5L5 33.5L10 28.5Z" class="opacity-10" /> --}}
        {{--       <path d="M52 28.5L52 14.5L47 9.5L42 14.5L42 28.5L47 33.5L52 28.5Z" /> --}}
        {{--       <path d="M37.5 33H14.5L9.5 38L14.5 43H37.5L42.5 38L37.5 33Z" /> --}}
        {{--       <path d="M10 61.5L10 47.5L5 42.5L-2.18557e-07 47.5L-8.30516e-07 61.5L5 66.5L10 61.5Z" /> --}}
        {{--       <path d="M52 61.5L52 47.5L47 42.5L42 47.5L42 61.5L47 66.5L52 61.5Z" class="opacity-10" /> --}}
        {{--       <path d="M37.5 66H14.5L9.5 71L14.5 76H37.5L42.5 71L37.5 66Z" /> --}}
        {{--     </svg> --}}
        {{--     <!-- 8 --> --}}
        {{--     <svg viewBox="0 0 52 76" class="h-4 w-3 fill-[#fdef7e] glow" xmlns="http://www.w3.org/2000/svg"> --}}
        {{--       <path d="M37.5 0H14.5L9.5 5L14.5 10H37.5L42.5 5L37.5 0Z" /> --}}
        {{--       <path d="M10 28.5L10 14.5L5 9.5L-2.18557e-07 14.5L-8.30516e-07 28.5L5 33.5L10 28.5Z" /> --}}
        {{--       <path d="M52 28.5L52 14.5L47 9.5L42 14.5L42 28.5L47 33.5L52 28.5Z" /> --}}
        {{--       <path d="M37.5 33H14.5L9.5 38L14.5 43H37.5L42.5 38L37.5 33Z" /> --}}
        {{--       <path d="M10 61.5L10 47.5L5 42.5L-2.18557e-07 47.5L-8.30516e-07 61.5L5 66.5L10 61.5Z" /> --}}
        {{--       <path d="M52 61.5L52 47.5L47 42.5L42 47.5L42 61.5L47 66.5L52 61.5Z" /> --}}
        {{--       <path d="M37.5 66H14.5L9.5 71L14.5 76H37.5L42.5 71L37.5 66Z" /> --}}
        {{--     </svg> --}}
        {{--   </div> --}}

        {{--   <div class="w-full font-wavefontx"> --}}
        {{--     <!-- <span class="scale-100">foo</span> --> --}}


        {{--   <svg viewBox="0 0 300 12" class="w-full font-wavefont fill-[#fdef7e] opacity-75"> --}}
        {{--     <text x="0" y="12" textLength="300" lengthAdjust="spacingAndGlyphs">13945819345918938645763899373495813948593188645763899373495813948593184593174895713894751938472</text> --}}
        {{--   </svg> --}}


        {{--     <!-- 01234567890 --> --}}
        {{--   </div> --}}

        {{--   <!-- <div class="h-0.5 w-full bg-[#fdef7e] bg-opacity-10"> --}}
        {{--     <div class="h-0.5 w-20 bg-[#fdef7e] glow"></div> --}}
        {{--   </div> --> --}}

        {{--   <div class="flex gap-1"> --}}
        {{--     <!-- 3 --> --}}
        {{--     <svg viewBox="0 0 52 76" class="h-4 w-3 fill-[#fdef7e] glow" xmlns="http://www.w3.org/2000/svg"> --}}
        {{--       <path d="M37.5 0H14.5L9.5 5L14.5 10H37.5L42.5 5L37.5 0Z" /> --}}
        {{--       <path d="M10 28.5L10 14.5L5 9.5L-2.18557e-07 14.5L-8.30516e-07 28.5L5 33.5L10 28.5Z" class="opacity-10" /> --}}
        {{--       <path d="M52 28.5L52 14.5L47 9.5L42 14.5L42 28.5L47 33.5L52 28.5Z" /> --}}
        {{--       <path d="M37.5 33H14.5L9.5 38L14.5 43H37.5L42.5 38L37.5 33Z" /> --}}
        {{--       <path d="M10 61.5L10 47.5L5 42.5L-2.18557e-07 47.5L-8.30516e-07 61.5L5 66.5L10 61.5Z" class="opacity-10" /> --}}
        {{--       <path d="M52 61.5L52 47.5L47 42.5L42 47.5L42 61.5L47 66.5L52 61.5Z" /> --}}
        {{--       <path d="M37.5 66H14.5L9.5 71L14.5 76H37.5L42.5 71L37.5 66Z" /> --}}
        {{--     </svg> --}}
        {{--     <!-- : --> --}}
        {{--     <svg viewBox="0 0 10 76" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-4 w-1 fill-[#fdef7e] glow"> --}}
        {{--       <path d="M5 26.5L10 21.5L5 16.5L-2.18557e-07 21.5L5 26.5Z" /> --}}
        {{--       <path d="M5 59.5L10 54.5L5 49.5L-2.18557e-07 54.5L5 59.5Z" /> --}}
        {{--     </svg> --}}
        {{--     <!-- 5 --> --}}
        {{--     <svg viewBox="0 0 52 76" class="h-4 w-3 fill-[#fdef7e] glow" xmlns="http://www.w3.org/2000/svg"> --}}
        {{--       <path d="M37.5 0H14.5L9.5 5L14.5 10H37.5L42.5 5L37.5 0Z" /> --}}
        {{--       <path d="M10 28.5L10 14.5L5 9.5L-2.18557e-07 14.5L-8.30516e-07 28.5L5 33.5L10 28.5Z" /> --}}
        {{--       <path d="M52 28.5L52 14.5L47 9.5L42 14.5L42 28.5L47 33.5L52 28.5Z" class="opacity-10" /> --}}
        {{--       <path d="M37.5 33H14.5L9.5 38L14.5 43H37.5L42.5 38L37.5 33Z" /> --}}
        {{--       <path d="M10 61.5L10 47.5L5 42.5L-2.18557e-07 47.5L-8.30516e-07 61.5L5 66.5L10 61.5Z" class="opacity-10" /> --}}
        {{--       <path d="M52 61.5L52 47.5L47 42.5L42 47.5L42 61.5L47 66.5L52 61.5Z" /> --}}
        {{--       <path d="M37.5 66H14.5L9.5 71L14.5 76H37.5L42.5 71L37.5 66Z" /> --}}
        {{--     </svg> --}}
        {{--     <!-- 1 --> --}}
        {{--     <svg viewBox="0 0 52 76" class="h-4 w-3 fill-[#fdef7e] glow" xmlns="http://www.w3.org/2000/svg"> --}}
        {{--       <path d="M37.5 0H14.5L9.5 5L14.5 10H37.5L42.5 5L37.5 0Z" class="opacity-10" /> --}}
        {{--       <path d="M10 28.5L10 14.5L5 9.5L-2.18557e-07 14.5L-8.30516e-07 28.5L5 33.5L10 28.5Z" class="opacity-10" /> --}}
        {{--       <path d="M52 28.5L52 14.5L47 9.5L42 14.5L42 28.5L47 33.5L52 28.5Z" /> --}}
        {{--       <path d="M37.5 33H14.5L9.5 38L14.5 43H37.5L42.5 38L37.5 33Z" class="opacity-10" /> --}}
        {{--       <path d="M10 61.5L10 47.5L5 42.5L-2.18557e-07 47.5L-8.30516e-07 61.5L5 66.5L10 61.5Z" class="opacity-10" /> --}}
        {{--       <path d="M52 61.5L52 47.5L47 42.5L42 47.5L42 61.5L47 66.5L52 61.5Z" /> --}}
        {{--       <path d="M37.5 66H14.5L9.5 71L14.5 76H37.5L42.5 71L37.5 66Z" class="opacity-10" /> --}}
        {{--     </svg> --}}
        {{--   </div> --}}
        {{-- </div> --}}
            </div>
        </div>
    </div>
</div>
