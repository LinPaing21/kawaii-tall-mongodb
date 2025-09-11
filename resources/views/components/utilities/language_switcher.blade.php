<div {{ $attributes->merge(['class' => 'relative']) }} x-data="{ open: false }" @click.away="open = false">
    <!-- Dropdown button -->
    <button
        @click="open = !open"
        class="flex items-center justify-between pl-3 pr-1 py-2 text-sm font-medium text-white transition-colors duration-200 bg-gray-800 rounded-lg shadow-md hover:bg-gray-700 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-50"
    >
        {{-- <span class="mr-2">{{ strtoupper(app()->getLocale()) }}</span> --}}
        <img src="{{ asset("assets/svg/". app()->getLocale() .".svg") }}" class="mr-2 w-6" alt="Flag of {{ strtoupper(app()->getLocale()) }}">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-4 h-4 transition-transform duration-200"
            :class="{ 'rotate-180': open }"
            viewBox="0 0 20 20"
            fill="currentColor"
        >
            <path
                fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 011.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z"
                clip-rule="evenodd"
            />
        </svg>
    </button>

    <!-- Dropdown menu -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 z-50 mt-2 origin-top-right bg-white border border-gray-200 rounded-md shadow-lg w-36"
        style="display: none"
    >
        <a
            href="{{ route('set-locale', 'en') }}"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
            @click="open = false"
        >
            English
        </a>
        <a
            href="{{ route('set-locale', 'my') }}"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
            @click="open = false"
        >
            မြန်မာ
        </a>
        {{-- <a
            href="{{ route('set-locale', 'jp') }}"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
            @click="open = false"
        >
            日本語
        </a> --}}
    </div>
</div>
