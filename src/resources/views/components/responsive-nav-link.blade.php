@props(['active'])

@php
$classes = ($active ?? false)
    ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-teal-600 text-base font-medium text-teal-800 bg-teal-50'
    : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-base font-medium text-stone-600 hover:text-stone-800 hover:bg-stone-100 hover:border-stone-300 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
