@props(['selections'])

<div
    class="p-4 bg-white dark:bg-gray-800 border-t border-r border-gray-200 dark:border-gray-700 rounded-tr-lg shadow-lg">
    <div class="space-y-4 max-w-[320px]">
        @foreach ($selections as $sectionIndex => $section)
            <div>
                <div class="bg-gray-100 dark:bg-gray-700 px-2 py-1 text-sm font-medium">
                    {{ $section['title'] }}
                </div>
                <div class="grid grid-cols-8 gap-px bg-gray-200 dark:bg-gray-600 text-sm">
                    @foreach ($section['answers'] as $index => $answer)
                        @php
                            $questionNumber = $index + 1;
                            $isGray = floor($index / 8) % 2 === 0;
                        @endphp

                        <button type="button" data-section="{{ $sectionIndex.','.$section['id'] }}" data-question="{{ $questionNumber }}"
                            class="flex flex-col items-center justify-center p-1 h-12 hover:bg-red-50 dark:hover:bg-red-900/20 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-inset {{ $isGray ? 'bg-gray-50 dark:bg-gray-800' : 'bg-white dark:bg-gray-900' }}">
                            <span class="font-medium">{{ $questionNumber }}</span>

                            <span class="text-xs text-gray-600 dark:text-gray-400">
                                {{ $answer }}
                            </span>
                        </button>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
