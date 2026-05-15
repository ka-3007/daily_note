<x-guest-layout>
  <header class="mb-8">
    <h1 class="text-2xl font-bold tracking-tight text-stone-900">{{ __('Register') }}</h1>
    <p class="mt-2 text-sm leading-relaxed text-stone-500">
      表示名・メール・パスワードを入力して、アカウントを作成します。
    </p>
  </header>

  <form method="POST" action="{{ route('register') }}" class="space-y-6" novalidate>
    @csrf

    <div>
      <x-input-label for="name" class="mb-1.5 text-stone-700" :value="__('Name')" />
      <x-text-input id="name"
        class="block w-full border-stone-300 bg-stone-50/50 text-stone-900 placeholder:text-stone-400 focus:border-teal-600 focus:ring-teal-600"
        type="text" name="name" :value="old('name')" autofocus autocomplete="name" placeholder="表示名" />
      <x-input-error :messages="$errors->get('name')" class="mt-2 leading-relaxed" />
    </div>

    <div>
      <x-input-label for="email" class="mb-1.5 text-stone-700" :value="__('Email')" />
      <x-text-input id="email"
        class="block w-full border-stone-300 bg-stone-50/50 text-stone-900 placeholder:text-stone-400 focus:border-teal-600 focus:ring-teal-600"
        type="email" name="email" :value="old('email')" autocomplete="username" placeholder="you@example.com" />
      <x-input-error :messages="$errors->get('email')" class="mt-2 leading-relaxed" />
    </div>

    <div>
      <x-input-label for="password" class="mb-1.5 text-stone-700" :value="__('Password')" />
      <x-text-input id="password"
        class="block w-full border-stone-300 bg-stone-50/50 text-stone-900 placeholder:text-stone-400 focus:border-teal-600 focus:ring-teal-600"
        type="password" name="password" autocomplete="new-password" placeholder="8文字以上" />
      <x-input-error :messages="$errors->get('password')" class="mt-2 leading-relaxed" />
    </div>

    <div>
      <x-input-label for="password_confirmation" class="mb-1.5 text-stone-700" :value="__('Confirm Password')" />
      <x-text-input id="password_confirmation"
        class="block w-full border-stone-300 bg-stone-50/50 text-stone-900 placeholder:text-stone-400 focus:border-teal-600 focus:ring-teal-600"
        type="password" name="password_confirmation" autocomplete="new-password" placeholder="もう一度入力" />
      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 leading-relaxed" />
    </div>

    <div class="pt-1">
      <x-primary-button
        class="w-full justify-center rounded-lg py-2.5 text-sm font-semibold normal-case tracking-normal">
        {{ __('Register') }}
      </x-primary-button>
    </div>
  </form>

  <p class="mt-8 text-center text-sm text-stone-500">
    すでにアカウントをお持ちの方は
    <a href="{{ route('login') }}"
      class="font-semibold text-teal-700 underline decoration-teal-700/30 underline-offset-2 transition hover:text-teal-800 hover:decoration-teal-800/50">
      {{ __('Log in') }}
    </a>
  </p>
</x-guest-layout>
