<main class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">Your JLPT Exam Results</h1>
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-2xl font-bold text-center mb-2"
            :class="{
                'text-green-600': '{{$isPass}}', //$result->pass_marks
                'text-red-600': '{{!$isPass}}'
            }">
            @if ($isPass)
                Passed
            @else
                Failed
            @endif
        </h2>
        <p class="text-center mb-4">JLPT {{ $result->exam->name }}</p>
        <div class="text-5xl font-bold text-center mb-4"
        :class="{
            'text-green-600': '{{$isPass}}',
            'text-red-600': '{{!$isPass}}'
        }">
            {{ $overAllPercentage }}%</div>
        <div class="w-full bg-gray-200 rounded-full h-4 mb-4">
            <div class="h-4 rounded-full" :class="{
                'bg-green-600': '{{$isPass}}',
                'bg-red-600': '{{!$isPass}}'
            }" style="width: {{ $overAllPercentage }}%"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>Exam Date: {{ Carbon\Carbon::parse($result->exam->created_at)->format('d M Y') }}</span>
            </div>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <span>Level: JLPT {{ $result->exam->level }}</span>
            </div>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Duration: 1:40</span>
            </div>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>Total Questions: {{ $totalQuestions }}</span>
            </div>
            <div class="flex items-center">
                <i class="fa-regular fa-star h-4 w-4 mr-2"></i>
                <span>Scores: {{ $totalScore }} / {{ $totalQuestions }}</span>
            </div>
            <div class="flex items-center">
                <i class="fa-solid fa-square-check h-4 w-4 mr-2" style="color: #1d775c;"></i>
                <span>Points: {{ floor(($totalScore / $totalQuestions) * 180) }} / 180</span>
            </div>
        </div>
    </div>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 mb-8">
        @foreach ($result->results as $section)
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="font-bold mb-2">{{ $section['title'] }}</h3>
                <div class="flex justify-between">
                    <p class="text-sm mb-2">Score: {{ $section['score'] }} / {{ count($section['answers']) }}</p>
                    <p class="text-sm mb-2">Points: {{ floor(($section['score'] / count($section['answers'])) * 60) }}
                        / 60</p>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="h-2 rounded-full"
                    :class="{
                        'bg-green-600': '{{floor(($section["score"] / count($section["answers"])) * 60) >= 19 }}', //$result->pass_marks
                        'bg-red-600': '{{floor(($section["score"] / count($section["answers"])) * 60) < 19 }}'
                    }"
                        style="width: {{ ($section['score'] / count($section['answers'])) * 100 }}%"></div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="flex justify-center gap-4 mb-8">

        <button wire:click="view" class="bg-primary text-white px-4 py-2 rounded-md flex items-center">
            <i class="fa-solid fa-eye me-3"></i>
            See Results
        </button>
        <button wire:click="share" class="bg-primary text-white px-4 py-2 rounded-md flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
            </svg>
            See Results
        </button>
    </div>
    <div x-data="{ showMessage: @entangle('showShareMessage') }" x-show="showMessage" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="fixed bottom-4 right-4 bg-black text-white p-2 rounded" x-init="setTimeout(() => showMessage = false, 3000)">
        Results link copied to clipboard!
    </div>
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-center mb-2">Support JLPT Master</h2>
        <p class="text-center mb-4">Your donations help us improve and create more study materials</p>
        <div class="grid gap-4 md:grid-cols-3">
            {{-- @foreach ($donationOptions as $option)
                <button class="border border-gray-300 rounded-md flex flex-col items-center p-4 hover:bg-gray-50 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span class="text-lg font-bold">${{ $option['amount'] }}</span>
                    <span class="text-sm text-gray-600">{{ $option['description'] }}</span>
                </button>
            @endforeach --}}
            <button
                class="border border-gray-300 rounded-md flex flex-col items-center p-4 hover:bg-gray-50 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 mb-2" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <span class="text-lg font-bold">$5</span>
                <span class="text-sm text-gray-600">Buy us a coffee</span>
            </button>
            <button
                class="border border-gray-300 rounded-md flex flex-col items-center p-4 hover:bg-gray-50 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 mb-2" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <span class="text-lg font-bold">$10</span>
                <span class="text-sm text-gray-600">Support server costs</span>
            </button>
            <button
                class="border border-gray-300 rounded-md flex flex-col items-center p-4 hover:bg-gray-50 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 mb-2" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <span class="text-lg font-bold">$25</span>
                <span class="text-sm text-gray-600">Help create new content</span>
            </button>
        </div>
    </div>
</main>
