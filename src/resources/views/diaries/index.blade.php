<x-app-layout>
  {{-- ページタイトル + 操作ボタン --}}
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-xl font-bold text-stone-900">日記</h1>
      <p class="mt-1 text-xs text-stone-500">あなたの1行日記</p>
    </div>
    <div class="flex items-center gap-2">
      {{-- 昇順/降順トグル --}}
      @php $nextOrder = $order === 'desc' ? 'asc' : 'desc'; @endphp
      <a href="{{ route('diaries.index', ['order' => $nextOrder]) }}"
        class="inline-flex items-center gap-1.5 rounded-lg border border-stone-300 bg-white px-3.5 py-2 text-sm font-medium text-stone-700 hover:bg-stone-100 transition">
        @if ($order === 'desc')
          <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
          </svg>
          降順
        @else
          <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
          </svg>
          昇順
        @endif
      </a>

      <a href="{{ route('diaries.create') }}"
        class="inline-flex items-center gap-1.5 rounded-lg bg-teal-700 px-4 py-2 text-sm font-semibold text-white hover:bg-teal-800 transition">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        新規投稿
      </a>
    </div>
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
          <div class="mt-2 text-xs text-stone-400">
            <time>{{ $diary->created_at->format('Y年n月j日 H:i') }}</time>
          </div>
        </div>
        <div class="flex items-center gap-2 flex-shrink-0">
          <div class="h-14 w-14 flex-shrink-0">
            @if ($diary->image_path)
              <img src="{{ Storage::disk('public')->url($diary->image_path) }}" alt=""
                class="h-14 w-14 rounded-lg object-cover border border-stone-200">
            @endif
          </div>
          <svg class="h-4 w-4 text-stone-300 group-hover:text-teal-600 transition" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
          </svg>
        </div>
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
