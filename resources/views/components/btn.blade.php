{{--
  Reusable Button Component  <x-btn>

  Renders an <a> or <button> with consistent brand colors (#5C80E0 primary).
  Hover, focus-visible, and active states are accessibility-compliant (WCAG 2.1 AA).

  Usage:
    <x-btn>Save</x-btn>
    <x-btn href="/checkout">Proceed to Checkout</x-btn>
    <x-btn variant="outline" size="sm" onclick="...">Cancel</x-btn>
    <x-btn variant="danger" type="submit">Delete</x-btn>
    <x-btn variant="ghost" size="xs">View all</x-btn>

  Props:
    href      (string|null)   — renders <a> when set, <button> otherwise
    type      (string)        — button type: 'button' | 'submit' | 'reset'
    variant   (string)        — 'primary' | 'secondary' | 'outline' | 'ghost' | 'dark' | 'danger' | 'warning'
    size      (string)        — 'xs' | 'sm' | 'md' | 'lg' | 'xl'
    disabled  (bool)          — grays out and disables interaction
    full      (bool)          — makes button full width (w-full)

  All extra attributes (class, data-*, aria-*, id, etc.) are forwarded via $attributes->merge().
--}}

@props([
    'href'     => null,
    'type'     => 'button',
    'variant'  => 'primary',
    'size'     => 'md',
    'disabled' => false,
    'full'     => false,
])

@php
// ── Variant classes ──────────────────────────────────────────────────────────
// Default color: #5C80E0 (primary-600)
// Hover:   ~12% darker (#4f6fc6)
// Active:  ~25% darker (#3d5aa8) — clearly darker than hover for "pressed" feel
// Focus:   visible ring (WCAG 2.1 SC 2.4.7)
// ─────────────────────────────────────────────────────────────────────────────
$variants = [
    'primary'   => 'bg-primary-600 hover:bg-primary-700 active:bg-primary-800 text-white'
                 . ' focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-600 focus-visible:ring-offset-2',
    'secondary' => 'bg-primary-800 hover:bg-primary-900 active:bg-primary-900 text-white'
                 . ' focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-700 focus-visible:ring-offset-2',
    'outline'   => 'border-2 border-primary-600 text-primary-600 bg-transparent hover:bg-primary-600 hover:text-white active:bg-primary-700 active:border-primary-700 active:text-white'
                 . ' dark:border-primary-400 dark:text-primary-400 dark:hover:bg-primary-600 dark:hover:text-white'
                 . ' focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-600 focus-visible:ring-offset-2',
    'ghost'     => 'text-primary-600 bg-transparent hover:bg-primary-100 active:bg-primary-200'
                 . ' dark:text-primary-400 dark:hover:bg-primary-900/30 dark:active:bg-primary-900/50'
                 . ' focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-600 focus-visible:ring-offset-2',
    'dark'      => 'bg-neutral-900 hover:bg-neutral-800 active:bg-neutral-700 text-white'
                 . ' dark:bg-neutral-700 dark:hover:bg-neutral-600'
                 . ' focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-neutral-700 focus-visible:ring-offset-2',
    'danger'    => 'bg-semantic-error hover:bg-red-700 active:bg-red-800 text-white'
                 . ' focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2',
    'warning'   => 'bg-semantic-warning hover:bg-amber-600 active:bg-amber-700 text-white'
                 . ' focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500 focus-visible:ring-offset-2',
];

// ── Size classes ─────────────────────────────────────────────────────────────
$sizes = [
    'xs' => 'px-2.5 py-1   text-xs  gap-1',
    'sm' => 'px-3   py-1.5 text-xs  gap-1.5',
    'md' => 'px-4   py-2   text-sm  gap-2',
    'lg' => 'px-6   py-3   text-base gap-2',
    'xl' => 'px-8   py-4   text-lg  gap-2.5',
];

// ── Base ─────────────────────────────────────────────────────────────────────
$base = 'inline-flex items-center justify-center font-semibold transition-all duration-200 select-none'
      . ($full ? ' w-full' : '')
      . ($disabled ? ' opacity-60 cursor-not-allowed pointer-events-none' : '');

$cls = $base
     . ' ' . ($variants[$variant] ?? $variants['primary'])
     . ' ' . ($sizes[$size]    ?? $sizes['md']);
@endphp

@if($href)
    <a href="{{ $href }}"
       {{ $attributes->merge(['class' => $cls]) }}
       @if($disabled) aria-disabled="true" tabindex="-1" @endif>
        {{ $slot }}
    </a>
@else
    <button
        type="{{ $type }}"
        @if($disabled) disabled @endif
        {{ $attributes->merge(['class' => $cls]) }}>
        {{ $slot }}
    </button>
@endif
