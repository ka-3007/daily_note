@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge([
    'class' => 'block w-full rounded-lg border-stone-300 bg-white text-stone-900 placeholder:text-stone-400 shadow-sm focus:border-teal-600 focus:ring-teal-600 disabled:bg-stone-100 disabled:cursor-not-allowed transition',
]) }}>
