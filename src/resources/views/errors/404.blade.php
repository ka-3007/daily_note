<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - ページが見つかりません | {{ config('app.name', 'Daily Note') }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-stone-50 font-sans antialiased">

    {{-- ヘッダー --}}
    <header class="bg-white border-b border-stone-200">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 h-14 flex items-center">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-stone-900 hover:text-teal-700 transition">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-md bg-teal-700 text-white">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h12a4 4 0 014 4v12a0 0 0 010 0H8a4 4 0 01-4-4V4z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 9h8M8 13h5" />
                    </svg>
                </span>
                <span class="text-base font-bold tracking-tight">{{ config('app.name', 'Daily Note') }}</span>
            </a>
        </div>
    </header>

    {{-- コンテンツ --}}
    <main class="max-w-3xl mx-auto px-4 sm:px-6 py-24 text-center">
        <p class="text-7xl font-bold text-teal-700 mb-4">404</p>
        <h1 class="text-xl font-bold text-stone-900 mb-2">ページが見つかりません</h1>
        <p class="text-sm text-stone-500 mb-10">お探しのページは削除されたか、URLが間違っている可能性があります。</p>

        <div class="inline-flex flex-col sm:flex-row items-center gap-3">
            @auth
                <a href="{{ route('diaries.index') }}"
                    class="inline-flex items-center gap-1.5 rounded-lg bg-teal-700 px-5 py-2.5 text-sm font-semibold text-white hover:bg-teal-800 transition">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 12l6-6m-6 6l6 6" />
                    </svg>
                    日記一覧へ
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="inline-flex items-center gap-1.5 rounded-lg bg-teal-700 px-5 py-2.5 text-sm font-semibold text-white hover:bg-teal-800 transition">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 12l6-6m-6 6l6 6" />
                    </svg>
                    ログインページへ
                </a>
            @endauth
        </div>
    </main>

</body>
</html>
