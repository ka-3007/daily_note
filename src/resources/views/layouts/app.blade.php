<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Daily Note') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-stone-800 bg-stone-50">
    <div class="min-h-screen flex flex-col">
        @include('layouts.navigation')

        <main class="flex-1 py-10">
            <div class="max-w-2xl mx-auto px-4 sm:px-6">
                @if (session('success'))
                    <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                        {{ session('success') }}
                    </div>
                @endif

                {{ $slot }}
            </div>
        </main>

        <footer class="border-t border-stone-200 bg-white py-4">
            <p class="text-center text-xs text-stone-400">
                &copy; {{ date('Y') }} {{ config('app.name', 'Daily Note') }}
            </p>
        </footer>
    </div>
</body>
</html>
