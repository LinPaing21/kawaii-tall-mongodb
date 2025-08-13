<div
    x-data="{ open: false }"
    x-on:open-share-popup.window="open = true"
    x-cloak
>
    <!-- Overlay -->
    <div
        x-show="open"
        class="fixed inset-0 bg-black/40 z-40"
        x-transition.opacity
        @click="open = false"
    ></div>

    <!-- Popup -->
    <div
        x-show="open"
        x-transition
        class="fixed z-50 inset-0 flex items-center justify-center px-4"
    >
        <div class="bg-white rounded-2xl shadow-lg max-w-sm w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Share</h2>
                <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                    ✕
                </button>
            </div>

            <div class="grid grid-cols-4 gap-4 text-center" x-data="{
    copyLink() {
        let text = `{{ $url . str_replace('``', '', $title) }}`;
        navigator.clipboard.writeText(text)
            .then(() => alert('Link copied!'))
            .catch(() => alert('Failed to copy link'));
    }
}">
                <!-- Telegram -->
                <button
                    class="flex flex-col items-center text-gray-600 hover:opacity-80"
                    data-sharer="telegram"
                    data-url="{{ $url }}"
                    data-title="{{ $title }}"
                    data-summary="{{ $title }}"
                    data-image="{{ $image }}"
                >
                    <i class="fa-brands fa-telegram mb-3 w-8 h-8"></i>
                    <span class="text-xs">Telegram</span>
                </button>

                <!-- Viber -->
                <button
                    class="flex flex-col items-center text-gray-600 hover:opacity-80"
                    data-sharer="viber"
                    data-title="{{ @explode('``', $title)[0] ?? 'Check it out!' }}"
                    data-url="{{ $url }}"
                >
                    <i class="fa-brands fa-viber mb-3 w-8 h-8"></i>
                    <span class="text-xs">Viber</span>
                </button>

                <!-- Email -->
                <button
                    class="flex flex-col items-center text-gray-600 hover:opacity-80"
                    data-sharer="email"
                    data-url="{{ $url }}"
                    data-title="{{ $title }}"
                >
                    <i class="fa-solid fa-envelope mb-3 w-8 h-8"></i>
                    <span class="text-xs">Email</span>
                </button>

                <!-- Facebook -->
                <button
                    class="flex flex-col items-center text-blue-600 hover:opacity-80"
                    data-sharer="facebook"
                    data-url="{{ $url }}"
                    data-hashtag="{{ $hashTag }}"
                >
                    <i class="fa-brands fa-facebook w-8 h-8 mb-3    "></i>
                    <span class="text-xs">Facebook</span>
                </button>

                <!-- Twitter -->
                <button
                    class="flex flex-col items-center text-sky-500 hover:opacity-80"
                    data-sharer="twitter"
                    data-title="{{ $title }}"
                    data-url="{{ $url }}"
                >
                    <i class="fa-brands fa-x-twitter w-8 h-8 mb-3"></i>
                    <span class="text-xs">X/Twitter</span>
                </button>

                <!-- Copy Link -->
                <button
                    class="flex flex-col items-center text-gray-600 hover:opacity-80"
                    @click="copyLink"
                >
                    <i class="fa-solid fa-copy mb-3 w-8 h-8"></i>
                    <span class="text-xs">Copy</span>
                </button>
            </div>
        </div>
    </div>
</div>

@push('after-scripts')
    <script src="{{ asset('js/third-parties/sharer.min.js') }}"></script>
@endpush


