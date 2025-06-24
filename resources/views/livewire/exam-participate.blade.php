<!-- resources/views/livewire/exam-participate.blade.php -->

@section('title', 'Exam Selection')
@section('home-classes', 'h-screen')
@section('custom-styles')
    <style>
        u {
            text-decoration: none;
            border-bottom: 4px solid #4A90E2;
        }

        /* Disable seek bar */
        audio::-webkit-media-controls-timeline {
            pointer-events: none;
        }

        audio::-moz-range-track {
            pointer-events: none;
        }

        progress {
            -webkit-appearance: none;
            appearance: none;
            pointer-events: none;
            height: 8px;
        }
    </style>
@endsection
@section('custom-footer')
    <p class="p-3"></p>
@endsection

<div class="flex flex-1 overflow-hidden" x-data="{ sidebarOpen: false }">
    <aside
        class="bg-gray-100 w-0 z-40 lg:z-0 lg:w-64 flex-shrink-0 transition-all duration-300 ease-in-out -translate-x-full lg:translate-x-0"
        :class="{ 'translate-x-0 w-64': sidebarOpen, '-translate-x-full': !sidebarOpen }">
        <div class="p-4 h-full flex flex-col" x-data="{
            icons: {
                'vocabulary': `<i class='w-10 h-10 fa-solid fa-book-open'></i>`,
                'grammar': `<i class='w-10 h-10 fa-solid fa-pen-nib'></i>`,
                'grammar_reading': `<i class='w-10 h-10 fa-solid fa-pen-nib'></i>`,
                'reading': `<i class='w-10 h-10 fa-regular fa-file-line'></i>`,
                'listening': `<i class='w-10 h-10 fa-solid fa-headphones'></i>`,
            },
            selectedSection: 'vocabulary',
        }" x-init="window.scrollTo({ top: 0 })">
            <x-scroll-area class="!flex-grow !overflow-y-auto">
                <div class="flex items-center gap-4 mb-4">
                    <x-utilities.back-btn />
                    <h2 class="text-lg font-semibold">Exam Sections</h2>
                </div>

                <!-- In your sidebar section -->
@foreach ($exam->exam_sections as $index => $section)
    <div key="{{ $section['id'] }}">
        <button
            class="inline-flex items-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 h-10 px-4 py-2 w-full justify-start relative
            @if($this->canAccessSection($index))
                hover:bg-accent hover:text-accent-foreground
            @else
                opacity-50 cursor-not-allowed
            @endif"
            :class="{
                'bg-red-100 text-red-600': {{ $this->isCurrentSection($index) ? 'true' : 'false' }},
                'bg-green-100 text-green-600': {{ $this->isSectionCompleted($index) ? 'true' : 'false' }}
            }"
            @if($this->canAccessSection($index))
                x-on:click="
                    document.querySelector('#content-scrollable').scrollTo({ top: 0 });
                    $wire.selectSection({{ $index }})
                "
            @else
                disabled
            @endif>

            <!-- Lock icon for inaccessible sections -->
            @if(!$this->canAccessSection($index))
                <i class="fa-solid fa-lock w-4 h-4 text-gray-400"></i>
            @else
                <span x-html="icons.{{ $section['id'] }}"></span>
            @endif

            <span class="ml-2">{{ $section['title'] }}</span>

            <!-- Status indicators -->
            @if($this->isSectionCompleted($index))
                <i class="fa-solid fa-check ml-auto w-4 h-4 text-green-600"></i>
            @elseif($this->isCurrentSection($index))
                <i class="fa-solid fa-arrow-right ml-auto w-4 h-4 text-red-600"></i>
            @endif
        </button>
        <div class="my-2 border-t border-gray-200"></div>
    </div>
@endforeach
                <x-question-navigator :selections="$examSelections" :selectedSectionId="$selectedSection['id']"/>
            </x-scroll-area>
        </div>
    </aside>
    <main class="flex-1 overflow-hidden flex flex-col">
        <div class="p-4 w-full max-w-4xl mx-auto flex">
            <button x-on:click="sidebarOpen = !sidebarOpen" type="button"
                class="lg:hidden py-3 px-5 rounded-lg hover:bg-gray-200 focus:ring-2 focus:ring-primary">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="w-1/2 ml-auto flex justify-between items-center">
        <!-- Previous Section (disabled in restricted mode) -->
        <button
            class="px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed"
            disabled>
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <!-- Section Progress -->
        <div class="text-center">
            <div class="text-sm text-gray-600 mb-1">
                Section {{ $currentSectionIndex + 1 }} of {{ count($exam->exam_sections) }}
            </div>
            {{-- <div class="text-lg font-semibold">{{ $selectedSection['title'] }}</div> --}}
        </div>

        <!-- Next Section or Submit -->
        {{-- @if($currentSectionIndex < count($exam->exam_sections) - 1)
            <button
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors"
                id="nextSectionBtn">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        @else
            <button
                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors submitAnswersBtn">
                Submit
                <i class="fa-solid fa-check"></i>
            </button>
        @endif --}}
        <button
                :disabled="{{ $currentSectionIndex >= count($exam->exam_sections) - 1 ? 'true' : 'false' }}"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors"
                :class="{'bg-gray-300 hover:bg-gray-300 text-gray-500 cursor-not-allowed': {{ $currentSectionIndex >= count($exam->exam_sections) - 1 ? 'true' : 'false' }}}"
                id="nextSectionBtn">
                <i class="fa-solid fa-chevron-right"></i>
        </button>
    </div>
        </div>

        <x-scroll-area class="!flex-1 !overflow-y-auto p-6 pb-0 pt-0 lg:pt-6 " :id="'content-scrollable'">
            <div class="max-w-4xl mx-auto bg-gray-100 p-5">
                <h1 class="text-2xl font-bold mb-4 text-center">{{ $selectedSection['title'] }}</h1>

                <h2 class="text-xl font-bold text-center">{{ $selectedSection['minutes'] }} Minutes</h2>

                @if ($selectedSection['id'] == 'listening')
                    <div x-init="initAudio('{{ $exam->audio_url }}')"
                        :class="{ 'hidden': '{{ $selectedSection['id'] }}' != 'listening' }">
                        <div class="flex items-center gap-4 mt-3">
                            <button @click="playAudio()"
                                class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                                ▶ Start
                            </button>
                            {{-- <button @click="pauseAudio()"
                                class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                                ⏸ Pause
                            </button>
                            <button @click="stopAudio()"
                                class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                ⏹ Stop
                            </button> --}}
                        </div>

                        <div class="flex items-center gap-2 mt-3">
                            <span id="currentTime" class="text-gray-700 text-sm w-10">0:00</span>
                            {{-- <input id="progressBar" type="range" min="0" max="100" value="0" step="0.1"
                                class="w-full cursor-pointer text-green-500" onchange="seekAudio(event)"> --}}
                            <input id="progressBar" type="range" min="0" max="100" value="0" step="0.1"
                                class="w-full cursor-not-allowed text-green-500" readonly>
                            <span id="duration" class="text-gray-700 text-sm w-12">0:00</span>
                        </div>
                    </div>
                @endif

                @php
                    $qIndex = 0;
                @endphp
                @foreach ($selectedSection['problems'] as $problem)
                    <div>
                        <hr class="my-5">

                        <h6 class="font-bold grid grid-cols-5 gap-3">
                            <span class="">もんだい {{ $problem['set'] }}</span>
                            <span class="col-span-4">{!! $problem['problem'] !!}</span>
                        </h6>

                        <hr class="my-5">

                        @isset($problem['example'])
                            <p class="mb-2">(れい) {!! $problem['example']['question'] !!}</p>
                            <ul class="flex gap-8">
                                @foreach ($problem['example']['options'] as $e_option)
                                    <li>
                                        {{-- {{ $e_option['no'] . '.  ' . $e_option['body'] }} --}}
                                        {{ $e_option['body'] }}
                                        @if ($e_option['is_correct'])
                                            <i class="w-4 h-4 fa-regular fa-circle-check" style="color: #36d372;"></i>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                            <hr class="my-5">
                        @endisset

                    </div>
                    @foreach ($problem['questions'] as $question)
                        <div class=" p-3 rounded-lg mb-6" id="{{ $selectedSection['id'] . '-' . $question['no'] }}">
                            <p class="mb-4">
                                @if (mb_strlen($question['question']) > 50 && $selectedSection['id'] != 'listening')
                                    {{-- {!! $question['question'] !!} <br><br> ({{ $question['no'] }}) --}}
                                    {!! $question['question'] !!}
                                @else
                                    {{-- ({{ $question['no'] }}) --}}
                                    {!! $question['question'] !!}
                                @endif
                            </p>
                            <div class="space-y-2">
                                @foreach ($question['options'] as $option)
                                    <button
                                        class="w-full text-left px-4 py-2 bg-white rounded-md hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors duration-200"
                                        wire:click="selectAnswer('{{ $selectedSection['id'] }}',{{ $qIndex }}, {{ $option['no'] }})"
                                        :class="{ 'bg-blue-100 outline-none ring-2 ring-blue-500 ring-opacity-50': '{{ $examSelections->where('title', $selectedSection['title'])->first()['answers'][$qIndex] == $option['no'] }}' }">
                                        {{-- {{ $option['no'] . '.  ' . $option['body'] }} --}}
                                        {{ $option['body'] }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        @php
                            $qIndex++;
                        @endphp
                    @endforeach
                @endforeach
                {{-- <div class="flex justify-between">
                    <button x-on:click="navigateToPreviousQuestion()"
                        class="px-4 py-1 bg-primary text-white rounded-lg hover:bg-blue-400">
                        <i class="fa-solid fa-angles-left"></i>
                    </button>
                    <button x-on:click="navigateToNextQuestion()"
                        class="px-4 py-1 bg-primary text-white rounded-lg hover:bg-blue-400">
                        <i class="fa-solid fa-angles-right"></i>
                    </button>
                </div> --}}
            </div>

            <x-utilities.scroll-up-button scrollableId="content-scrollable" />
        </x-scroll-area>
        <!-- Add this at the bottom of your main content area -->
{{-- <div class="sticky bottom-0 bg-white border-t border-gray-200 p-4 mt-6">

</div> --}}
    </main>
</div>

@script
<script defer>
    document.querySelector('#nextSectionBtn').addEventListener('click', function () {
            Swal.fire({
            title: 'Move to Next Section?',
            text: "You won't be able to return to this section once you proceed!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, continue!',
            cancelButtonText: 'Stay here'
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector('#content-scrollable').scrollTo({ top: 0 });
                $wire.nextSection();
            }
        });
    });

    document.querySelectorAll('[data-section][data-question]').forEach(button => {
        button.addEventListener('click', function () {
            const section = this.dataset.section;
            const question = this.dataset.question;
            // You can customize this to match your navigation needs
            navigateToQuestion(section, question);
        });
    });

    async function navigateToQuestion(section, question) {
        let index;

        ([index, section] = section.split(','));

        console.log(section + "==" + $wire.selectedSection['id'])
        if (section == $wire.selectedSection['id']) {
            const questionElement = document.querySelector(`#${section}-${question}`); //scroll based navigation
            questionElement?.scrollIntoView({
                behavior: 'smooth'
            });
        } else {
            console.log(`index: ${index}`);

            await $wire.selectSection(index);

            console.log('here')
            const questionElement = document.querySelector(`#${section}-${question}`); //scroll based navigation
            questionElement?.scrollIntoView({
                behavior: 'smooth'
            });
        }
    }

    document.querySelector('#submitAnswersBtn').addEventListener('click', function () {
        console.log('Submit button clicked');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to change your answers after submitting!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $wire.submit();
            }
        });
    });

    $wire.on('timeup', () => {
        Swal.fire({
            icon: 'warning',
            title: 'Time is up!',
            text: 'Your exam will be submitted automatically.',
            showConfirmButton: false,
            timer: 2000
        }).then(() => {
            $wire.submit();
        });
    });

    $wire.on('show-submit-error', (event) => {
        Swal.fire({
            icon: event[0].type.toLowerCase(), // 'success', 'error', 'warning'
            title: event[0].type,
            text: event[0].message,
            confirmButtonText: 'OK'
        });
    });

    let sectionDuration = {{ $currentSectionTimeRemaining }};
    let sectionTimer;
    const sectionTimerElement = document.getElementById("sectionTimer");

    function updateSectionTimer() {
        const minutes = Math.floor(sectionDuration / 60);
        const seconds = sectionDuration % 60;

        if (!sectionTimerElement) return;

        sectionTimerElement.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

        {{-- // Update Livewire component
        $wire.updateTimeRemaining(sectionDuration); --}}

        // Color coding based on time remaining
        if (sectionDuration == 300) { // 5 minutes
            sectionTimerElement.classList.add('text-red-600', 'animate-pulse');

            Swal.fire({
                title: '⏰ 5 Minutes Left!',
                text: 'You have 5 minutes remaining for this section.',
                icon: 'warning',
                timer: 3000,
                showConfirmButton: false
            });
        } else if (sectionDuration == 600) { // 10 minutes
            sectionTimerElement.classList.add('text-yellow-600');
        }

        if (sectionDuration > 0) {
            sectionDuration--;
        } else {
            clearInterval(sectionTimer);
            $wire.handleSectionTimeUp();
        }
    }

    function startSectionTimer(duration) {
        sectionDuration = duration;
        clearInterval(sectionTimer);
        sectionTimer = setInterval(updateSectionTimer, 1000);

        // Reset styling
        sectionTimerElement.classList.remove('text-red-600', 'text-yellow-600', 'animate-pulse');
    }

    // Listen for section changes
    $wire.on('section-timer-reset', (event) => {
        startSectionTimer(event[0].newDuration);

        // Show section change notification
        Swal.fire({
            title: 'Section Changed!',
            text: `Now starting: ${event[0].sectionTitle}`,
            icon: 'info',
            timer: 2000,
            showConfirmButton: false
        });
    });

    // Auto-advance to next section
    $wire.on('auto-advance-section', () => {
        setTimeout(() => {
            document.querySelector('#content-scrollable').scrollTo({ top: 0 });
            $wire.nextSection();
        }, 2000);
    });

    // Start initial timer
    startSectionTimer(sectionDuration);
</script>
@endscript

@push('after-scripts')
    @vite('resources/js/audio.js')
@endpush
