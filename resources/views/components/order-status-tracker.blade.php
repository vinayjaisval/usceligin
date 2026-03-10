@props(['order', 'statusStep'])

@php
    $steps = config('order.status_steps');
    $progressPct = ($statusStep - 1) / (count($steps) - 1) * 100;
@endphp

<div class="flex items-center justify-between relative" role="list" aria-label="Order progress">
    {{-- Background connector --}}
    <div class="absolute left-0 right-0 top-4 h-0.5 bg-gray-200 dark:bg-gray-700 z-0" aria-hidden="true"></div>
    {{-- Filled progress --}}
    <div class="absolute left-0 top-4 h-0.5 bg-orange-500 z-0 transition-all duration-500"
         style="width: {{ $progressPct }}%"
         aria-hidden="true"></div>

    @foreach($steps as $step => $info)
        @php
            $done    = $step <= $statusStep;
            $current = $step === $statusStep;
        @endphp
        <div class="relative z-10 flex flex-col items-center gap-1.5"
             style="width: {{ 100 / count($steps) }}%"
             role="listitem"
             aria-label="Step {{ $step }}: {{ $info['label'] }}{{ $current ? ' (current)' : ($done ? ' (completed)' : '') }}">
            <div class="w-8 h-8 flex items-center justify-center
                {{ $done    ? 'bg-orange-500 text-white'                            : 'bg-gray-200 dark:bg-gray-700 text-gray-400 dark:text-gray-500' }}
                {{ $current ? 'ring-2 ring-orange-300 dark:ring-orange-700 ring-offset-1' : '' }}"
                 aria-hidden="true">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $info['icon'] }}"/>
                </svg>
            </div>
            <span class="text-xs text-center leading-tight
                {{ $done ? 'text-gray-900 dark:text-gray-100 font-semibold' : 'text-gray-400 dark:text-gray-500' }}">
                {{ $info['label'] }}
            </span>
        </div>
    @endforeach
</div>
