@section('title', 'Exam Selection')

<main class="flex-1 container mx-auto px-4 py-4 sm:py-8" x-data="{ selectedExam: null}">
    <!-- Mobile-friendly title -->
    <h1 class="text-2xl sm:text-3xl font-bold mb-6 sm:mb-8 text-center">Choose Your JLPT Exam</h1>

    <div class="flex flex-col md:flex-row gap-4 mb-8">
        <div class="relative flex-grow">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="search" id="default-search"
                class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-offset-2 focus:ring-2 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search for exams..." wire:model.live.debounce.300ms="search" />
        </div>
        <div class="flex items-center gap-4">
            <x-utilities.select-dropdown :options="$years" :id="'year'" :selected="$selectedYear" />
        <x-utilities.select-dropdown :options="$difficultyLevels" :id="'level'" :selected="$selectedLevel" />
        </div>

    </div>

    <!-- Pagination - mobile friendly -->
    <div class="mb-4">
        {{ $exams->links() }}
    </div>

    @if ($exams->count())
        <!-- Mobile-optimized exam grid -->
        <div class="grid gap-4 sm:gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 mt-5">
            @foreach ($exams as $exam)
                <div class="rounded-lg border bg-white py-6 sm:py-7 px-4 shadow-sm cursor-pointer transition-all hover:shadow-md"
                    x-bind:class="{ 'ring-2 ring-red-600 shadow-lg': '{{ $exam->id }}' == '{{ $selectedExam?->id }}' }"
                    @dblclick="window.location = '{{ route("exam-participate", ["exam" => $exam->id]) }}'"
                    @click='selectedExam = @json(["id"=>$exam->id, "level"=>$exam->level, "year"=>$exam->year->format("F Y")])'
                    data-modal-target="mode-select-modal" data-modal-toggle="mode-select-modal">
                    <div class="header">
                        <h3 class="text-xl sm:text-2xl font-bold text-center mb-3 sm:mb-4">{{ $exam->level }}</h3>
                        <p class="text-sm sm:text-base text-center mb-3 sm:mb-4 text-gray-600">{{ $exam->year->format('F Y') }}
                        </p>
                    </div>
                    <div class="content">
                        <p class="text-sm sm:text-base text-center text-gray-700">{{ $exam->description }}</p>
                    </div>

                    <!-- Mobile: Add visual indicator for selection -->
                    <div class="mt-4 text-center sm:hidden" x-show="'{{ $exam->id }}' == '{{ $selectedExam?->id }}'">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-red-100 text-red-800">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Selected
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Mobile-optimized empty state -->
        <div class="flex flex-col items-center justify-center w-full mx-auto p-6 sm:p-8">
            <div class="bg-gray-100 p-4 rounded-full mb-4">
                <i class="fa-solid fa-magnifying-glass text-2xl text-gray-500"></i>
            </div>
            <h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-2 text-center">No Results Found!</h2>
            <p class="text-sm sm:text-base text-gray-600 text-center px-4">
                We couldn't find any matching results. Try adjusting your search criteria.
            </p>
        </div>
    @endif

    <!-- Mobile-optimized study materials section -->
        <div wire:ignore id="mode-select-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700 p-5">
                {{-- @if ($selectedExam) --}}
                        <h2 class="text-lg sm:text-2xl font-bold mb-4 sm:mb-6 text-center">
                            JLPT <span x-text="selectedExam?.level"></span>
                            <span class="sm:inline text-sm sm:text-base font-normal text-gray-600 mt-1 sm:mt-0" x-text="selectedExam?.year">
                            </span>
                        </h2>

                        <!-- Mobile: 2 columns, Desktop: 4 columns -->
                        <div class="grid gap-3 sm:gap-4 grid-cols-2">
                            <a :href="'{{ route('exam-participate', ['exam' => 'EXAM_ID', 'examMode' => \App\Enums\ExamMode::PRACTICE])}}'.replace('EXAM_ID', selectedExam?.id)"
                                class="h-20 sm:h-24 flex flex-col items-center justify-center space-y-1 sm:space-y-2 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition-colors">
                                <i class="fa-solid fa-file-lines text-lg sm:text-xl text-green-600"></i>
                                <span class="text-xs sm:text-sm text-center px-1 text-green-700 font-medium">Start Test</span>
                                <span class="text-xs text-green-600 block">(Pratice Mode)</span>
                            </a>

                            <a :href="'{{ route('exam-participate', ['exam' => 'EXAM_ID'])}}'.replace('EXAM_ID', selectedExam?.id)"
                                class="h-20 sm:h-24 flex flex-col items-center justify-center space-y-1 sm:space-y-2 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 transition-colors"
                                wire:navigate>
                                <i class="fa-solid fa-file-lines text-lg sm:text-xl text-red-600"></i>
                                <span class="text-xs sm:text-sm text-center px-1 text-red-700 font-medium">Start Test</span>
                                <span class="text-xs text-red-600 block">(Restricted Mode)</span>
                            </a>
                        </div>
                {{-- @endif --}}
                </div>
            </div>
        </div>
</main>
