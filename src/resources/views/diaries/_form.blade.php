{{--
  共通フォームパーツ
  $diary  : 編集時は Diary モデル / 新規作成時は null
  $action : form の action URL
  $method : 'POST'（新規） または 'PUT'（編集）
  $submitLabel : ボタンのラベル
--}}

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-6"
    x-data="{
        imageError: '',
        checkImageSize(e) {
            const file = e.target.files[0];
            const maxBytes = 5 * 1024 * 1024;
            if (file && file.size > maxBytes) {
                this.imageError = '画像は5MB以下のファイルを選択してください。';
                e.target.value = '';
            } else {
                this.imageError = '';
            }
        }
    }"
    @submit.prevent="imageError ? null : $el.submit()"
>
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    {{-- 本文 --}}
    <div>
        <label for="content" class="block text-sm font-medium text-stone-700 mb-1.5">本文</label>
        <textarea
            id="content"
            name="content"
            rows="4"
            maxlength="500"
            required
            placeholder="今日あったことをひとことで…"
            class="block w-full rounded-lg border-stone-300 bg-stone-50/50 text-stone-900 placeholder:text-stone-400 focus:border-teal-600 focus:ring-teal-600 resize-none"
        >{{ old('content', $diary?->content) }}</textarea>
        <div class="mt-1 flex justify-between">
            <x-input-error :messages="$errors->get('content')" class="text-xs" />
            <p class="text-xs text-stone-400">最大 500 文字</p>
        </div>
    </div>

    {{-- 画像 --}}
    <div>
        <label for="image" class="block text-sm font-medium text-stone-700 mb-1.5">画像（任意）</label>

        @if ($diary?->image_path)
            <div class="mb-3 flex items-center gap-3">
                <img
                    src="{{ Storage::disk('public')->url($diary->image_path) }}"
                    alt="現在の画像"
                    class="h-20 w-20 object-cover rounded-lg border border-stone-200"
                />
                <p class="text-xs text-stone-400">新しい画像を選択すると上書きされます</p>
            </div>
        @endif

        <input
            id="image"
            name="image"
            type="file"
            accept=".jpg,.jpeg"
            @change="checkImageSize($event)"
            class="block w-full text-sm text-stone-600
                   file:mr-3 file:py-2 file:px-3.5
                   file:rounded-lg file:border-0
                   file:text-sm file:font-medium
                   file:bg-teal-50 file:text-teal-700
                   hover:file:bg-teal-100 cursor-pointer"
        />
        <p class="mt-1 text-xs text-stone-400">JPG 形式・5MB 以内</p>
        <p x-show="imageError" x-text="imageError" class="mt-1 text-xs text-red-600"></p>
        <x-input-error :messages="$errors->get('image')" class="mt-1 text-xs" />
    </div>

    {{-- 送信 --}}
    <div class="flex items-center justify-end gap-3 pt-2">
        <a href="{{ route('diaries.index') }}" class="text-sm font-medium text-stone-500 hover:text-stone-700">
            キャンセル
        </a>
        <x-primary-button>
            {{ $submitLabel }}
        </x-primary-button>
    </div>
</form>
