<x-app-layout>
    {{-- パンくず --}}
    <a href="{{ route('diaries.index') }}"
        class="inline-flex items-center gap-1 text-sm text-stone-500 hover:text-stone-800 mb-4 transition">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        一覧へ戻る
    </a>

    <article class="bg-white rounded-xl border border-stone-200 overflow-hidden">
        @if ($diary->image_path)
            <div class="bg-stone-100">
                <img
                    src="{{ Storage::disk('public')->url($diary->image_path) }}"
                    alt=""
                    class="w-full max-h-[480px] object-cover"
                >
            </div>
        @endif

        <div class="p-6 sm:p-8">
            <p class="text-base leading-relaxed text-stone-900 whitespace-pre-wrap">{{ $diary->content }}</p>
            <p class="mt-4 text-xs text-stone-400">
                {{ $diary->created_at->format('Y年n月j日 H:i') }}
                @if ($diary->updated_at->ne($diary->created_at))
                    ・更新 {{ $diary->updated_at->format('Y年n月j日 H:i') }}
                @endif
            </p>
        </div>

        <div class="flex items-center justify-end gap-2 px-6 sm:px-8 py-4 bg-stone-50 border-t border-stone-100">
            <a href="{{ route('diaries.edit', $diary) }}"
                class="inline-flex items-center gap-1.5 rounded-lg border border-stone-300 bg-white px-3.5 py-2 text-sm font-medium text-stone-700 hover:bg-stone-100 transition">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                編集
            </a>

            <form method="POST" action="{{ route('diaries.destroy', $diary) }}"
                onsubmit="return confirm('この日記を削除しますか？');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-white px-3.5 py-2 text-sm font-medium text-red-600 hover:bg-red-50 transition">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3" />
                    </svg>
                    削除
                </button>
            </form>
        </div>
    </article>
</x-app-layout>
