<!-- Update your question-navigator.blade.php -->
@props(['selections', 'selectedSectionId' => '', 'canAccessSection' => null, 'currentSectionIndex' => 0])

<div class="p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg">
    <div class="space-y-4 max-w-[320px]">
        @foreach ($selections as $sectionIndex => $section)
            <div class="relative">
                {{-- Lock overlay if section is not accessible --}}
                @if (!$this->canAccessSection($sectionIndex))
                    <div class="absolute inset-0 backdrop-blur-sm bg-white/70 dark:bg-gray-900/70 z-10 flex items-center justify-center rounded-md">
                        <div class="text-center">
                            <svg class="w-6 h-6 text-gray-500 mx-auto mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <span class="text-xs text-gray-500">Locked</span>
                        </div>
                    </div>
                @endif

                <div class="{{ !$this->canAccessSection($sectionIndex) ? 'pointer-events-none select-none' : '' }}">
                    <div class="px-2 py-1 text-sm font-medium flex items-center justify-between
                        {{ $sectionIndex === $currentSectionIndex ? 'bg-red-100 text-red-700' : 'bg-gray-100 dark:bg-gray-700' }}">
                        <span>{{ $section['title'] }}</span>
                        @if($sectionIndex === $currentSectionIndex)
                            <span class="text-xs bg-red-200 text-red-800 px-2 py-1 rounded-full">Current</span>
                        @elseif($sectionIndex < $currentSectionIndex)
                            <i class="fa-solid fa-check text-green-600"></i>
                        @endif
                    </div>

                    <!-- Rest of your question grid -->
                    <div class="grid grid-cols-8 gap-px bg-gray-200 dark:bg-gray-600 text-sm">
                        @foreach ($section['answers'] as $index => $answer)
                            @php
                                $questionNumber = $index + 1;
                                $isGray = floor($index / 8) % 2 === 0;
                            @endphp

                            <button type="button"
                                data-section="{{ $sectionIndex.','.$section['id'] }}"
                                data-question="{{ $questionNumber }}"
                                class="flex flex-col items-center justify-center p-1 h-12 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-inset
                                {{ $this->canAccessSection($sectionIndex) ? 'hover:bg-red-50 dark:hover:bg-red-900/20' : '' }}
                                {{ $isGray ? 'bg-gray-50 dark:bg-gray-800' : 'bg-white dark:bg-gray-900' }}"
                                {{ !$this->canAccessSection($sectionIndex) ? 'disabled' : '' }}>
                                <span class="font-medium">{{ $questionNumber }}</span>
                                <span class="text-xs text-gray-600 dark:text-gray-400">{{ $answer }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
