<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Daily Note') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-stone-800 bg-stone-100">
    <div class="min-h-screen flex flex-col">
        <div class="h-1 bg-gradient-to-r from-teal-700 via-teal-600 to-stone-600" aria-hidden="true"></div>

        <header class="px-4 py-4 sm:px-6">
            <div class="max-w-3xl mx-auto flex items-center justify-between">
                <span class="text-base font-bold tracking-tight text-stone-900">
                    {{ config('app.name', 'Daily Note') }}
                </span>
                @if (Route::has('login'))
                    <nav class="flex items-center gap-3 text-sm">
                        @auth
                            <a href="{{ route('diaries.index') }}"
                                class="font-medium text-teal-700 hover:text-teal-800">
                                日記一覧へ
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-stone-600 hover:text-stone-900">
                                ログイン
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="inline-flex items-center rounded-lg bg-teal-700 px-4 py-2 font-medium text-white hover:bg-teal-800">
                                    新規登録
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <main class="flex-1 flex items-center justify-center px-4 py-12 sm:py-16">
            <div class="max-w-lg w-full text-center">
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-stone-900">
                    毎日を、ひとことで。
                </h1>
                <p class="mt-4 text-base leading-relaxed text-stone-600">
                    1行の日記と1枚の写真で、<br class="hidden sm:inline">
                    あなたの毎日をシンプルに残せます。
                </p>

                @guest
                    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
                        <a href="{{ route('register') }}"
                            class="w-full sm:w-auto inline-flex justify-center items-center rounded-lg bg-teal-700 px-6 py-3 text-sm font-semibold text-white hover:bg-teal-800 transition">
                            はじめる
                        </a>
                        <a href="{{ route('login') }}"
                            class="w-full sm:w-auto inline-flex justify-center items-center rounded-lg border border-stone-300 bg-white px-6 py-3 text-sm font-semibold text-stone-700 hover:bg-stone-50 transition">
                            ログイン
                        </a>
                    </div>
                @else
                    <div class="mt-8">
                        <a href="{{ route('diaries.index') }}"
                            class="inline-flex justify-center items-center rounded-lg bg-teal-700 px-6 py-3 text-sm font-semibold text-white hover:bg-teal-800 transition">
                            日記を書く
                        </a>
                    </div>
                @endguest
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
