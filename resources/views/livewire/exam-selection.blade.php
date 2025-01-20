@section('title', 'Exam Selection')

<main class="flex-1 container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">Choose Your JLPT Exam</h1>
    <div class="flex flex-col md:flex-row gap-4 mb-8">
        <div class="relative flex-grow">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="search" id="default-search"
                class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-offset-2 focus:ring-2 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search for exams..." wire:model.live.debounce.300ms="search" />
        </div>

        <x-utilities.select-dropdown :options="$years" :id="'year'" :selected="$selectedYear" />
        <x-utilities.select-dropdown :options="$difficultyLevels" :id="'level'" :selected="$selectedLevel" />
    </div>
    {{ $exams->links() }}

    @if ($exams->count())
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 mt-5">
            @foreach ($exams as $exam)
                <div class="rounded-lg border bg-white py-7 px-4 bg-card text-card-foreground shadow-sm cursor-pointer transition-all"
                    x-bind:class="{ 'ring-2 ring-red-600': '{{ $exam->id }}' == '{{ $selectedExam?->id }}' }"
                    wire:click="setSelectedExam('{{ $exam->id }}')">
                    <div class="header">
                        <h3 class="text-2xl font-bold text-center mb-4">{{ $exam->level }}</h3>
                        <p class="description text-center mb-4">{{ $exam->year->format('F Y') }}</p>
                    </div>
                    <div class="content">
                        <p class="description text-center">{{ $exam->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex flex-col items-center justify-center w-full  mx-auto p-6">
            <div class="bg-white p-4 rounded-full mb-4">
                <i class="fa-solid fa-magnifying-glass w-8 h-8"></i>
            </div>
            <h2 class="text-xl font-semibold text-gray-800 mb-2">No Results Found!</h2>
            <p class="text-gray-600 text-center">
                We couldn't find any matching results. Try adjusting your search criteria.
            </p>
        </div>
    @endif




    @if ($selectedExam)
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Study Materials for JLPT {{ $selectedExam->level }}
                ({{ $selectedExam->year->format('F Y') }})</h2>
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                <button class="h-24 flex flex-col items-center justify-center space-y-2">
                    <i class="fa-solid fa-graduation-cap h-8 w-8 "></i>

                    <span>Lessons</span>
                </button>
                <button class="h-24 flex flex-col items-center justify-center space-y-2">
                    <i class="fa-solid fa-file-lines h-8 w-8 text-secondary"></i>

                    <span>Practice Tests</span>
                </button>
                <button class="h-24 flex flex-col items-center justify-center space-y-2">
                    <i class="fa-solid fa-signal h-8 w-8 text-secondary"></i>

                    <span>Progress Tracking</span>
                </button>
                <button class="h-24 flex flex-col items-center justify-center space-y-2">
                    <i class="fa-solid fa-users h-8 w-8 text-secondary"></i>

                    <span>Community</span>
                </button>
            </div>
        </div>
    @endif
</main>
