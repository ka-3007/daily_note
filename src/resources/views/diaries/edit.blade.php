<x-app-layout>
    <a href="{{ route('diaries.show', $diary) }}"
        class="inline-flex items-center gap-1 text-sm text-stone-500 hover:text-stone-800 mb-4 transition">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        詳細へ戻る
    </a>

    <div class="bg-white rounded-xl border border-stone-200 p-6 sm:p-8">
        <h1 class="text-xl font-bold text-stone-900 mb-1">日記を編集</h1>
        <p class="text-sm text-stone-500 mb-6">本文や画像を変更できます。</p>

        @include('diaries._form', [
            'diary'       => $diary,
            'action'      => route('diaries.update', $diary),
            'method'      => 'PUT',
            'submitLabel' => '更新する',
        ])
    </div>
</x-app-layout>
