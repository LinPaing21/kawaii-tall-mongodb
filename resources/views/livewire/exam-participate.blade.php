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
                'reading': `<i class='w-10 h-10 fa-regular fa-file-line'></i>`,
                'listening': `<i class='w-10 h-10 fa-solid fa-headphones'></i>`,
            },
            selectedSection: 'vocabulary',
        }" x-init="window.scrollTo({ top: 0 })">
            <x-scroll-area class="!flex-grow !overflow-y-auto">
                <h2 class="text-lg font-semibold mb-4">Exam Sections</h2>

                @foreach ($exam->exam_sections as $index => $section)
                    <div key="{{ $section['id'] }}">
                        <button
                            class="inline-flex items-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 w-full justify-start "
                            :class="{
                                'bg-red-100 text-red-600': '{{ $selectedSection['id'] }}'
                                === '{{ $section['id'] }}'
                            }"
                            x-on:click="
                                document.querySelector('#content-scrollable').scrollTo({ top: 0 });

                                $wire.selectSection({{ $index }})
                            ">
                            <span x-html="icons.{{ $section['id'] }}"></span>
                            <span class="ml-2">{{ $section['title'] }}</span>
                        </button>
                        <div class="my-2 border-t border-gray-200"></div>
                    </div>
                @endforeach
                <x-question-navigator :selections="$examSelections" />
            </x-scroll-area>
        </div>
    </aside>
    <main class="flex-1 overflow-hidden flex flex-col">
        <div class="p-4 lg:hidden">
            <button x-on:click="sidebarOpen = !sidebarOpen" type="button"
                class="py-3 px-5 rounded-lg hover:bg-gray-200 focus:ring-2 focus:ring-primary">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <x-scroll-area class="!flex-1 !overflow-y-auto p-6 pb-0" :id="'content-scrollable'">
            <div class="max-w-4xl mx-auto bg-gray-100 p-5">
                <h1 class="text-2xl font-bold mb-4 text-center">{{ $selectedSection['title'] }}</h1>
                <h2 class="text-xl font-bold text-center">{{ $selectedSection['minutes'] }} Minutes</h2>

                @if ($selectedSection['id'] == 'listening')
                    <div x-init="initAudio('{{ $exam->audio_file }}');
                    updateExamDuration({{ $selectedSection['minutes'] }})" :class="{ 'hidden': '{{ $selectedSection['id'] }}' != 'listening' }">
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
                            {{-- <input id="progressBar" type="range" min="0" max="100" value="0"
                            step="0.1" class="w-full cursor-pointer accent-green-500" onchange="seekAudio(event)"> --}}
                            <input id="progressBar" type="range" min="0" max="100" value="0"
                                step="0.1" class="w-full cursor-not-allowed accent-green-500" readonly>
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
                                    <li>{{ $e_option['no'] . '.  ' . $e_option['body'] }}
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
                                    {!! $question['question'] !!} <br><br> ({{ $question['no'] }})
                                @else
                                    ({{ $question['no'] }})
                                    {!! $question['question'] !!}
                                @endif
                            </p>
                            <div class="space-y-2">
                                @foreach ($question['options'] as $option)
                                    <button
                                        class="w-full text-left px-4 py-2 bg-white rounded-md hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors duration-200"
                                        wire:click="selectAnswer('{{ $selectedSection['title'] }}',{{ $qIndex }}, {{ $option['no'] }})"
                                        :class="{ 'bg-blue-100 outline-none ring-2 ring-blue-500 ring-opacity-50': '{{ $examSelections->where('title', $selectedSection['title'])->first()['answers'][$qIndex] == $option['no'] }}' }">
                                        {{ $option['no'] . '.  ' . $option['body'] }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        @php
                            $qIndex++;
                        @endphp
                    @endforeach
                @endforeach
            </div>
            <button x-on:click="document.querySelector('#content-scrollable').scrollTo({ top: 0, behavior: 'smooth' })"
                class="fixed bottom-4 right-4 w-10 h-10  bg-blue-500 text-white rounded-full shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                <i class="fa-solid fa-arrow-up"></i>
            </button>
        </x-scroll-area>
    </main>
</div>

@script
    <script>
        document.querySelectorAll('[data-section][data-question]').forEach(button => {
            button.addEventListener('click', function() {
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

        document.querySelector('#submitAnswersBtn').addEventListener('click', function() {
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
        })
    </script>
@endscript

@push('after-scripts')
    @vite('resources/js/audio.js')

    <script>
        let duration = {{ collect($exam->exam_sections)->sum('minutes') }} * 60; // 2 hours in seconds

        document.addEventListener('DOMContentLoaded', function() {
            let countdownElement = document.getElementById("countdown");

            function updateTimer() {
                let hours = Math.floor(duration / 3600);
                let minutes = Math.floor((duration % 3600) / 60);
                let seconds = duration % 60;

                countdownElement.textContent =
                    `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

                if (duration > 0) {
                    duration--;
                } else {
                    clearInterval(timer);
                    alert("Time is up! The exam has ended.");
                }
            }

            let timer = setInterval(updateTimer, 1000);


        });

        function updateExamDuration(minutes) {
            duration = minutes * 60;
        }
    </script>
@endpush
