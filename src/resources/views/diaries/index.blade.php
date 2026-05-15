<x-app-layout>
    {{-- ページタイトル + 新規投稿ボタン --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-stone-900">日記</h1>
            <p class="mt-1 text-xs text-stone-500">あなたの1行日記</p>
        </div>
        <a href="{{ route('diaries.create') }}"
            class="inline-flex items-center gap-1.5 rounded-lg bg-teal-700 px-4 py-2 text-sm font-semibold text-white hover:bg-teal-800 transition">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            新規投稿
        </a>
    </div>

    {{-- 一覧 --}}
    @forelse ($diaries as $diary)
        <a href="{{ route('diaries.show', $diary) }}"
            class="group block bg-white rounded-xl border border-stone-200 hover:border-teal-600/40 hover:shadow-sm transition p-5 mb-3">
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0 mt-1">
                    <span class="inline-flex h-2 w-2 rounded-full bg-teal-600"></span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm text-stone-900 leading-relaxed line-clamp-2 group-hover:text-teal-800 transition">
                        {{ $diary->content }}
                    </p>
                    <div class="mt-2 flex items-center gap-2 text-xs text-stone-400">
                        <time>{{ $diary->created_at->format('Y年n月j日 H:i') }}</time>
                        @if ($diary->image_path)
                            <span class="inline-flex items-center gap-1 text-stone-400">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                画像あり
                            </span>
                        @endif
                    </div>
                </div>
                <svg class="h-4 w-4 text-stone-300 group-hover:text-teal-600 transition flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </a>
    @empty
        <div class="bg-white rounded-xl border border-dashed border-stone-300 p-10 text-center">
            <p class="text-sm text-stone-500">まだ日記がありません。</p>
            <a href="{{ route('diaries.create') }}"
                class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-teal-700 hover:text-teal-800">
                最初の日記を書く
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    @endforelse

    {{-- ページネーション --}}
    @if ($diaries->hasPages())
        <div class="mt-6">
            {{ $diaries->links() }}
        </div>
    @endif
</x-app-layout>
