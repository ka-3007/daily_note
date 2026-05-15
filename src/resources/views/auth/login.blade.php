<x-guest-layout>
  <header class="mb-8">
    <h1 class="text-2xl font-bold tracking-tight text-stone-900">ログイン</h1>
    <p class="mt-2 text-sm leading-relaxed text-stone-500">
      メールアドレスとパスワードでサインインしてください。
    </p>
  </header>

  <x-auth-session-status
    class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800"
    :status="session('status')" />

  <form method="POST" action="{{ route('login') }}" class="space-y-6" novalidate>
    @csrf

    <div>
      <x-input-label for="email" class="mb-1.5 text-stone-700" value="メールアドレス" />
      <x-text-input id="email"
        class="block w-full border-stone-300 bg-stone-50/50 text-stone-900 placeholder:text-stone-400 focus:border-teal-600 focus:ring-teal-600"
        type="email" name="email" :value="old('email')" autofocus autocomplete="username"
        placeholder="you@example.com" />
      <x-input-error :messages="$errors->get('email')" class="mt-2 leading-relaxed" />
    </div>

    <div>
      <x-input-label for="password" class="mb-1.5 text-stone-700" value="パスワード" />
      <x-text-input id="password"
        class="block w-full border-stone-300 bg-stone-50/50 text-stone-900 placeholder:text-stone-400 focus:border-teal-600 focus:ring-teal-600"
        type="password" name="password" autocomplete="current-password" placeholder="••••••••" />
      <x-input-error :messages="$errors->get('password')" class="mt-2 leading-relaxed" />
    </div>

    <div class="flex items-center gap-2">
      <input id="remember_me" type="checkbox" name="remember"
        class="h-4 w-4 rounded border-stone-300 text-teal-700 shadow-sm focus:ring-teal-600">
      <label for="remember_me" class="text-sm text-stone-600 select-none">ログイン状態を保持する</label>
    </div>

    <div>
      <x-primary-button class="w-full py-2.5">
        ログイン
      </x-primary-button>
    </div>
  </form>

  <p class="mt-8 text-center text-sm text-stone-500">
    アカウントをお持ちでない方は
    <a href="{{ route('register') }}"
      class="font-semibold text-teal-700 underline decoration-teal-700/30 underline-offset-2 transition hover:text-teal-800 hover:decoration-teal-800/50">
      新規登録
    </a>
  </p>
</x-guest-layout>
