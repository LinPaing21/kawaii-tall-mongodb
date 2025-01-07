<header class="px-4 lg:px-6 h-16 flex items-center bg-white border-b border-red-100">
    <a class="flex items-center justify-center" href="#">
        <i class="fa-solid fa-book-open h-6 w-6 text-red-600"></i>
        <span class="ml-2 font-bold text-gray-800">{{ config('app.name') }}</span>
    </a>
    <nav class="ml-auto flex gap-4 sm:gap-6 items-center">
        <a class="text-sm font-medium hover:text-red-600 transition-colors" href="#">
            About JLPT
        </a>
        <a class="text-sm font-medium hover:text-red-600 transition-colors" href="#">
            Resources
        </a>
        <a class="text-sm font-medium hover:text-red-600 transition-colors" href="#">
            Contact
        </a>
        @if (Route::has('login'))
            @auth
                <div x-data="{ 'isOpen': false }">
                    <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600"
                        x-bind:class="{ 'ring-primary ring-2 ring-offset-2': isOpen }" id="menu-button" aria-expanded="true"
                        aria-haspopup="true" @click="isOpen = !isOpen">

                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=0D8ABC&color=fff"
                            alt="{{ auth()->user()->name }}" />
                    </div>
                    <div x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75 transform"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                        <div class="py-1" role="none">
                            <!-- Active: "bg-gray-100 text-gray-900 outline-none", Not Active: "text-gray-700" -->
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 hover:text-gray-900 hover:outline-none"
                                x-binding:class="{'bg-gray-100 text-gray-900 outline-none': isOpen}" role="menuitem"
                                tabindex="-1" id="menu-item-0">Account settings</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 hover:text-gray-900 hover:outline-none""
                                x-binding:class="{'bg-gray-100 text-gray-900 outline-none': isOpen}" role="menuitem"
                                tabindex="-1" id="menu-item-1">Support</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 hover:text-gray-900 hover:outline-none""
                                x-binding:class="{'bg-gray-100 text-gray-900 outline-none': isOpen}" role="menuitem"
                                tabindex="-1" id="menu-item-2">License</a>
                            <form method="POST" action="#" role="none">
                                <button type="submit"
                                    class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-200 hover:text-gray-900 hover:outline-none""
                                    x-binding:class="{'bg-gray-100 text-gray-900 outline-none': isOpen}" role="menuitem"
                                    tabindex="-1" id="menu-item-3">Sign out</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="text-sm font-medium hover:text-red-600 transition-colors border-l border-gray-400 px-3">Sign
                    in</a>

                {{-- @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="text-sm font-medium hover:text-red-600 transition-colors">Register</a>
                @endif --}}
            @endauth
        @endif
    </nav>
</header>
