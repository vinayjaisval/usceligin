@props([
    'photo'     => null,
    'thumbnail' => null,
    'name'      => 'Product',
    'class'     => 'w-full h-full object-cover',
])

@if($photo)
    <img src="{{ asset('assets/images/products/' . $photo) }}"
         alt="{{ $name }}"
         class="{{ $class }}"
         loading="lazy" />
@elseif($thumbnail)
    <img src="{{ asset('assets/images/thumbnails/' . $thumbnail) }}"
         alt="{{ $name }}"
         class="{{ $class }}"
         loading="lazy" />
@else
    <div class="w-full h-full flex items-center justify-center" aria-hidden="true">
        <span class="material-icons-outlined text-gray-300 dark:text-gray-500 text-2xl">image</span>
    </div>
@endif
