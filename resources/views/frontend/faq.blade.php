@extends('frontend.include.app')

@section('content')

<main id="main-content" role="main" class="bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <nav aria-label="Breadcrumb" class="mb-6">
            <ol class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                <li>
                    <a href="{{ route('front.index') }}" class="hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-200">Home</a>
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-gray-900 dark:text-gray-100" aria-current="page">Faq</span>
                </li>
            </ol>
        </nav>
    </div>

    <div class="bg-gray-50 dark:bg-gray-800 py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-gray-100 mb-4">Faq</h1>
            <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">How do I identify if a Korean skincare product is genuine?</p>
        </div>
    </div>

    <!-- FAQ Content -->
    <div class=" space-y-5 max-w-xs sm:max-w-sm md:max-w-3xl  lg:max-w-4xl mx-auto shadow-heavy bg-white dark:bg-gray-900 mt-16 mb-16">
        <!-- Expandable Sections -->
        <div class=" dark:border-gray-700  ">
            @php
            $accordionSections = [
            [
            'id' => 'details',
            'title' => 'Details',
            'content' => $productt->description ?? '<p>Detailed product information coming soon.</p>',
            'isHtml' => true
            ],
            [
            'id' => 'how-to-use',
            'title' => 'How To Use',
            'content' => $productt->how_to_use ?? '<ol class="list-decimal list-inside space-y-2">
                <li>Apply a small amount to clean, damp skin or hair</li>
                <li>Gently massage in circular motions</li>
                <li>Allow to absorb fully before applying other products</li>
                <li>Use daily for best results</li>
            </ol>',
            'isHtml' => true
            ],
            [
            'id' => 'ingredients',
            'title' => 'Ingredients',
            'content' => $productt->ingredients ?? '<p>Aqua, Glycerin, Natural Extracts, Vitamin E, Hyaluronic Acid, and other premium ingredients. Full ingredient list available on product packaging.</p>',
            'isHtml' => true
            ]
            ];
            @endphp

            @foreach($accordionSections as $section)
            <div class="accordion-item border-b border-gray-200 dark:border-gray-700">
                <a href="#"
                    class="accordion-trigger w-full flex items-center justify-between py-4 px-4 text-left hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500"
                    aria-expanded="false" data-accordion="{{ $section['id'] }}">
                    <span class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ $section['title'] }}</span>
                    <svg class="accordion-icon w-4 h-4 text-gray-900 dark:text-gray-100 transition-transform duration-200"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </a>
                <div
                    class="accordion-content hidden py-4 px-4 mt-1 mb-4 text-sm text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-800/50"
                    id="{{ $section['id'] }}-content">
                    @if($section['isHtml'])
                    {!! clean($section['content'], [
                    'HTML.Allowed' => 'p,br,strong,em,ul,ol,li,span',
                    'AutoFormat.RemoveEmpty' => true
                    ]) !!}
                    @else
                    {{ $section['content'] }}
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>

@endsection
@section('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        'use strict';
        const DOM = {
            // Options
            deliveryOptions: document.querySelectorAll('.delivery-option'),
            accordionTriggers: document.querySelectorAll('.accordion-trigger')
        };
        // ========================================
        // Accordion Handler
        // ========================================
        const AccordionManager = {
            init() {
                DOM.accordionTriggers.forEach(trigger => {
                    trigger.addEventListener('click', (e) => {
                        e.preventDefault();
                        this.toggle(e.currentTarget);
                    });
                });
            },

            toggle(trigger) {
                const isExpanded = trigger.getAttribute('aria-expanded') === 'true';

                // Close all accordions
                this.closeAll();

                // Open clicked accordion if it was closed
                if (!isExpanded) {
                    this.open(trigger);
                }
            },

            closeAll() {
                DOM.accordionTriggers.forEach(trigger => {
                    const item = trigger.closest('.accordion-item');
                    const content = item.querySelector('.accordion-content');
                    const icon = trigger.querySelector('.accordion-icon');

                    content.classList.add('hidden');
                    trigger.setAttribute('aria-expanded', 'false');
                    icon.style.transform = 'rotate(0deg)';
                });
            },

            open(trigger) {
                const item = trigger.closest('.accordion-item');
                const content = item.querySelector('.accordion-content');
                const icon = trigger.querySelector('.accordion-icon');

                content.classList.remove('hidden');
                trigger.setAttribute('aria-expanded', 'true');
                icon.style.transform = 'rotate(45deg)';
            }
        };


        AccordionManager.init();
    });
</script>