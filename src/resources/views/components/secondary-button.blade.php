<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'inline-flex items-center justify-center px-4 py-2 bg-white border border-stone-300 rounded-lg font-medium text-sm text-stone-700 hover:bg-stone-50 focus:outline-none focus:ring-2 focus:ring-teal-600 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition',
]) }}>
    {{ $slot }}
</button>
