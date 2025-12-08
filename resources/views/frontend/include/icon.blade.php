@props([
  'name' => 'info',
  'variant' => 'outlined', // 'filled', 'outlined', 'round', 'sharp', 'two-tone'
  'size' => 'base', // 'xs', 'sm', 'base', 'lg', 'xl', '2xl'
  'class' => ''
])

{{--
  Reusable Material Icon Component

  Usage:
  @include('frontend.include.icon', ['name' => 'shopping_cart', 'variant' => 'outlined'])

  Or with custom classes:
  @include('frontend.include.icon', [
    'name' => 'favorite',
    'variant' => 'filled',
    'size' => 'lg',
    'class' => 'text-red-600'
  ])
--}}

@php
  $sizeClasses = [
    'xs' => 'text-xs',
    'sm' => 'text-sm',
    'base' => 'text-base',
    'lg' => 'text-lg',
    'xl' => 'text-xl',
    '2xl' => 'text-2xl',
  ];

  $variantClass = match($variant) {
    'filled' => 'material-icons',
    'outlined' => 'material-icons-outlined',
    'round' => 'material-icons-round',
    'sharp' => 'material-icons-sharp',
    'two-tone' => 'material-icons-two-tone',
    default => 'material-icons-outlined'
  };

  $sizeClass = $sizeClasses[$size] ?? 'text-base';
  $classes = trim("{$variantClass} {$sizeClass} {$class}");
@endphp

<span class="{{ $classes }}" aria-hidden="true">{{ $name }}</span>
