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

<body class="font-sans antialiased text-stone-800 bg-stone-100 overflow-x-hidden">
  <div class="min-h-screen flex flex-col">
    <div class="h-1 bg-gradient-to-r from-teal-700 via-teal-600 to-stone-600" aria-hidden="true"></div>

    <div class="flex-1 flex flex-col items-center justify-center px-4 py-12 sm:px-6 sm:py-16">
      <div class="w-full max-w-md">
        <div class="mb-8 text-center">
          <a href="/"
            class="inline-block rounded-xl px-2 py-1 text-lg font-bold tracking-tight text-stone-900 outline-none ring-offset-2 ring-offset-stone-100 focus-visible:ring-2 focus-visible:ring-teal-600">
            {{ config('app.name', 'Daily Note') }}
          </a>
        </div>

        <div class="rounded-2xl border border-stone-200 bg-white p-8 shadow-sm sm:p-12">
          {{ $slot }}
        </div>
      </div>
    </div>
  </div>
</body>

</html>
