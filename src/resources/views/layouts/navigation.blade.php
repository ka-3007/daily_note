<nav x-data="{ open: false }" class="bg-white border-b border-stone-200">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-center h-14">
            <a href="{{ route('diaries.index') }}" class="inline-flex items-center gap-2 text-stone-900 hover:text-teal-700 transition">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-md bg-teal-700 text-white">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h12a4 4 0 014 4v12a0 0 0 010 0H8a4 4 0 01-4-4V4z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 9h8M8 13h5" />
                    </svg>
                </span>
                <span class="text-base font-bold tracking-tight">{{ config('app.name', 'Daily Note') }}</span>
            </a>

            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button type="button" class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-stone-600 hover:text-stone-900 rounded-lg hover:bg-stone-50 transition">
                            <span class="inline-flex h-7 w-7 items-center justify-center rounded-full bg-stone-200 text-stone-700 text-xs font-semibold">
                                {{ mb_substr(Auth::user()->name, 0, 1) }}
                            </span>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4 text-stone-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">プロフィール</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                ログアウト
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" type="button" class="p-2 rounded-lg text-stone-500 hover:text-stone-700 hover:bg-stone-100">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-stone-100 bg-stone-50">
        <div class="px-4 py-3 border-b border-stone-100">
            <div class="font-medium text-base text-stone-800">{{ Auth::user()->name }}</div>
            <div class="text-sm text-stone-500">{{ Auth::user()->email }}</div>
        </div>
        <div class="py-2 space-y-1">
            <x-responsive-nav-link :href="route('profile.edit')">プロフィール</x-responsive-nav-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    ログアウト
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
