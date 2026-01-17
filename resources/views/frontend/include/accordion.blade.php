@props(['items' => [], 'id' => 'accordion', 'type' => 'default'])

{{--
  Reusable Accordion Component

  Usage:
  @include('frontend.include.accordion', [
    'id' => 'payment-accordion',
    'type' => 'radio', // 'default' or 'radio'
    'items' => [
      [
        'id' => 'item1',
        'title' => 'Accordion Title 1',
        'content' => '<p>Accordion content here</p>',
        'open' => true, // Optional: open by default
        'radio_name' => 'payment_method', // For radio type
        'radio_value' => '1' // For radio type
      ],
      [
        'id' => 'item2',
        'title' => 'Accordion Title 2',
        'content' => '<p>More content</p>'
      ]
    ]
  ])
--}}

<div class="space-y-2" id="{{ $id }}">
  @foreach($items as $index => $item)
    @php
      $itemId = $item['id'] ?? $id . '_' . $index;
      $isOpen = $item['open'] ?? ($index === 0);
      $hasRadio = $type === 'radio' && isset($item['radio_name']);
    @endphp

    <!-- Accordion Item -->
    <div class="border border-gray-200 dark:border-gray-600 overflow-hidden bg-white dark:bg-gray-800">

      <!-- Accordion Header -->
      <button
        type="button"
        onclick="toggleAccordion('{{ $itemId }}')"
        class="w-full flex items-center justify-between p-4 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors text-left"
        aria-expanded="{{ $isOpen ? 'true' : 'false' }}"
        aria-controls="content_{{ $itemId }}">

        <div class="flex items-center space-x-3 flex-1">
          @if($hasRadio)
            <input
              type="radio"
              name="{{ $item['radio_name'] }}"
              value="{{ $item['radio_value'] ?? $index }}"
              id="radio_{{ $itemId }}"
              class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
              {{ $isOpen ? 'checked' : '' }}
              onclick="event.stopPropagation();" />
          @endif

          <span class="font-medium text-gray-900 dark:text-gray-100">
            {{ $item['title'] }}
          </span>
        </div>

        <span
          id="chevron_{{ $itemId }}"
          class="material-icons-outlined text-gray-600 dark:text-gray-400 transform transition-transform {{ $isOpen ? 'rotate-180' : '' }}"
          aria-hidden="true">
          expand_more
        </span>
      </button>

      <!-- Accordion Content -->
      <div
        id="content_{{ $itemId }}"
        class="{{ $isOpen ? '' : 'hidden' }} p-4 border-t border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-900/50"
        role="region"
        aria-labelledby="header_{{ $itemId }}">
        {!! $item['content'] !!}
      </div>
    </div>
  @endforeach
</div>

<script>
  function toggleAccordion(itemId) {
    const content = document.getElementById('content_' + itemId);
    const chevron = document.getElementById('chevron_' + itemId);
    const button = content.previousElementSibling;

    // Toggle current item
    const isHidden = content.classList.contains('hidden');
    content.classList.toggle('hidden');
    chevron.classList.toggle('rotate-180');
    button.setAttribute('aria-expanded', isHidden ? 'true' : 'false');

    // For radio type, close other items (optional - remove if you want multiple open)
    const accordionId = itemId.split('_')[0];
    const radioInput = document.getElementById('radio_' + itemId);
    if (radioInput) {
      radioInput.checked = true;

      // Close all other accordion items in this group
      const allContents = document.querySelectorAll(`[id^="content_${accordionId}"]`);
      allContents.forEach(otherContent => {
        if (otherContent.id !== 'content_' + itemId) {
          otherContent.classList.add('hidden');
          const otherChevron = document.getElementById(otherContent.id.replace('content_', 'chevron_'));
          if (otherChevron) {
            otherChevron.classList.remove('rotate-180');
          }
          const otherButton = otherContent.previousElementSibling;
          if (otherButton) {
            otherButton.setAttribute('aria-expanded', 'false');
          }
        }
      });
    }
  }
</script>
