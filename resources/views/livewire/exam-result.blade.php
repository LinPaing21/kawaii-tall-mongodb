<main class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">Your JLPT Exam Results</h1>

    <!-- Encouraging Results Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <!-- Mobile-First Responsive Design -->
        <div class="mb-6">
            <!-- Mobile Layout -->
            <div class="block sm:hidden">
                <!-- Status Badge at Top on Mobile -->
                <div class="text-center mb-4">
                    <div class="inline-flex items-center bg-white border-2 rounded-lg px-4 py-2 shadow-sm
                @if($isPass) border-green-200
                @else border-orange-200 @endif">
                        <span class="text-2xl mr-2">{{ $encouragingMessage['icon'] }}</span>
                        <span class="text-xl font-bold
                    @if($isPass) text-green-600
                    @else text-orange-600 @endif">
                            {{ $isPass ? 'Passed' : 'Failed' }}
                        </span>
                    </div>
                </div>

                <!-- Message Content -->
                <div class="text-center">
                    <h2 class="text-xl font-bold mb-2
                @if($encouragingMessage['color'] === 'green') text-green-600
                @elseif($encouragingMessage['color'] === 'yellow') text-yellow-600
                @elseif($encouragingMessage['color'] === 'orange') text-orange-600
                @else text-blue-600 @endif">
                        {{ $encouragingMessage['status'] }}
                    </h2>
                    <p class="text-sm text-gray-600 mb-2 px-4">{{ $encouragingMessage['message'] }}</p>
                    <p class="text-xs text-gray-500">JLPT {{ $result->exam->name }}</p>
                </div>
            </div>

            <!-- Desktop Layout (Hidden on Mobile) -->
            <div class="hidden sm:flex sm:items-center">
                <div class="text-4xl mr-4">{{ $encouragingMessage['icon'] }}</div>
                <div class="flex-1">
                    <h2 class="text-2xl font-bold mb-2
                @if($encouragingMessage['color'] === 'green') text-green-600
                @elseif($encouragingMessage['color'] === 'yellow') text-yellow-600
                @elseif($encouragingMessage['color'] === 'orange') text-orange-600
                @else text-blue-600 @endif">
                        {{ $encouragingMessage['status'] }}
                    </h2>
                    <p class="text-gray-600 mb-2">{{ $encouragingMessage['message'] }}</p>
                    <p class="text-sm text-gray-500">JLPT {{ $result->exam->name }}</p>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold mb-2
                @if($isPass) text-green-600
                @else text-orange-600 @endif">
                        {{ $isPass ? 'Passed' : 'Failed' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="w-full bg-gray-200 rounded-full h-4 mb-6">
            <div class="h-4 rounded-full transition-all duration-500
                @if($encouragingMessage['color'] === 'green') bg-green-600
                @elseif($encouragingMessage['color'] === 'yellow') bg-yellow-500
                @elseif($encouragingMessage['color'] === 'orange') bg-orange-500
                @else bg-blue-500 @endif" style="width: {{ $overAllPercentage }}%"></div>
        </div>

        <!-- Exam Details -->
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
            {{-- <div class="flex items-center">
                <i class="fa-regular fa-star h-4 w-4 mr-2"></i>
                <span>Scores: {{ $totalScore }} / {{ $totalQuestions }}</span>
            </div> --}}
            <div class="flex items-center">
                <i class="fa-solid fa-square-check h-4 w-4 mr-2" style="color: #1d775c;"></i>
                <span>Points: ~ {{ $totalPoints }} / 180</span>
            </div>
        </div>
    </div>

    <!-- Personalized Study Recommendations -->
    {{-- @if($overAllPercentage < 60) <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h3 class="text-xl font-semibold mb-4 flex items-center">
            <span class="text-2xl mr-3">📚</span>
            Your Personalized Study Plan
        </h3>
        <p class="text-gray-600 mb-6">Based on your performance, here's what we recommend focusing on:</p>

        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3 mb-6">
            @foreach ($result->results as $section)
            @php
            $sectionPercentage = ($section['score'] / $section['max_score']) * 100;
            $needsImprovement = $sectionPercentage < 50; @endphp <div
                class="border rounded-lg p-4 {{ $needsImprovement ? 'border-red-200 bg-red-50' : 'border-green-200 bg-green-50' }}">
                <div class="flex justify-between items-center mb-3">
                    <h4 class="font-medium">{{ $section['title'] }}</h4>
                    <span class="text-sm font-semibold {{ $needsImprovement ? 'text-red-600' : 'text-green-600' }}">
                        {{ $section['score'] }}/{{ $section['max_score'] }}
                    </span>
                </div>

                @if($needsImprovement)
                <p class="text-sm text-red-700 mb-3 font-medium">⚠️ Priority Focus Area</p>
                <ul class="text-sm text-red-600 space-y-1">
                    @if(str_contains($section['title'], 'Letters') || str_contains($section['title'], 'Vocabulary'))
                    <li>• Practice Hiragana/Katakana daily (15 min)</li>
                    <li>• Learn 10 new vocabulary words per day</li>
                    <li>• Use flashcards for kanji recognition</li>
                    @elseif(str_contains($section['title'], 'Grammar'))
                    <li>• Review basic sentence patterns</li>
                    <li>• Practice particle usage (は, が, を, に)</li>
                    <li>• Study verb conjugations</li>
                    @elseif(str_contains($section['title'], 'Listening'))
                    <li>• Listen to Japanese podcasts daily</li>
                    <li>• Practice with audio drills</li>
                    <li>• Watch Japanese content with subtitles</li>
                    @endif
                </ul>
                @else
                <p class="text-sm text-green-700 flex items-center">
                    <span class="mr-2">✅</span>
                    Great job! Keep practicing to maintain this level
                </p>
                @endif
        </div>
        @endforeach
        </div>

        <!-- Action Buttons for Study Plan -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold text-center transition-colors flex items-center justify-center">
                <span class="mr-2">📖</span>
                Start Recommended Study Plan
            </a>
            <a href="#"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold text-center transition-colors flex items-center justify-center">
                <span class="mr-2">🔄</span>
                Try Another Practice Test
            </a>
        </div>
        </div>
        @endif --}}

        <!-- Section Breakdown (Your existing section cards, but enhanced) -->
        <div class="grid gap-6 md:grid-cols-2 mb-8" :class="{'lg:grid-cols-3': {{ isset($sectionalResults['third']) ? 1 : 0 }}}">
            @foreach (Arr::except($sectionalResults, 'total') as $key => $value)
                @php
                    $base = 60;
                    $point = 0;
                    $sectionPassed = false;
                    if (isset($sectionalResults['third'])) {
                        $title = [
                            "first" => "Language Knowledge (Vocabulary/Grammar)",
                            "second" => "Reading",
                            "third" => "Listening"
                        ];
                        $point = $value;
                        $sectionPassed = $point >= 19;
                        $title = $title[$key];
                    } else {
                        $title = [
                            "first" => "Language Knowledge (Vocabulary/Grammar) + Reading",
                            "second" => "Listening",
                        ];
                        if($key == 'second') {
                            $point = $sectionalResults["second"];
                            $sectionPassed = $point >= 19;
                        } else {
                            $point = $sectionalResults["first"];
                            $sectionPassed = $point >= 38;
                            $base = 120;
                        }
                        $title = $title[$key];
                    }
                    $sectionPercentage = $point / $base * 100;
                @endphp

                <div class="bg-white rounded-lg shadow-md p-4 {{ !$sectionPassed ? 'ring-2 ring-red-200' : '' }}">
                    <h3 class="font-bold text-ellipsis line-clamp-1">{{ $title }}</h3>

                    <div class="flex justify-between">
                        <p class="text-sm mb-2">Points: ~ {{ $point }}</p>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="h-2 rounded-full {{ $sectionPassed ? 'bg-green-600' : 'bg-red-600' }}"
                            style="width: {{ $sectionPercentage }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Motivational Message -->
        @if($overAllPercentage < 60)
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-6 mb-8 text-center">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Remember: Every Expert Was Once a Beginner! 💪</h3>
                <p class="text-gray-600 mb-4">You've taken an important step by practicing. Each attempt makes you stronger
                    and more prepared for success.</p>
                <p class="text-sm text-gray-500 italic">"Success is not final, failure is not fatal: it is the courage to
                    continue that counts."</p>
            </div>
        @endif

        <!-- Your existing buttons and donation section remain the same -->
        <div class="flex justify-center gap-4 mb-8">
            <button wire:click="viewDetailResult" class="bg-primary text-white px-4 py-2 rounded-md flex items-center">
                <i class="fa-solid fa-eye me-3"></i>
                See Results
            </button>
            <button wire:click="share" class="bg-primary text-white px-4 py-2 rounded-md flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                </svg>
                Share Results
            </button>
        </div>

        <!-- Rest of your existing code (share message, donation section) -->
        <div x-data="{ showMessage: @entangle('showShareMessage') }" x-show="showMessage"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
            class="fixed bottom-4 right-4 bg-black text-white p-2 rounded"
            x-init="setTimeout(() => showMessage = false, 3000)">
            Results link copied to clipboard!
        </div>

        {{-- <!-- Your existing donation section -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-center mb-2">Support JLPT Master</h2>
            <p class="text-center mb-4">Your donations help us improve and create more study materials</p>
            <div class="grid gap-4 md:grid-cols-3">
                <!-- Your existing donation buttons -->
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
        </div> --}}

        @guest
            @include('components.login-suggestion')
        @endguest
</main>

@script
    <script defer>
        $wire.on('copy-to-clipboard', (event) => {
            navigator.clipboard.writeText(event[0].text)
        });
    </script>
@endscript

@push('after-scripts')
    @vite('resources/js/exam-tracker.js')
    <script defer>
        window.isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};

        if ({{ url()->previous() == route('exam-participate', ['exam' => $result->exam->id]) ? 1 : 0 }}) {
            document.addEventListener('DOMContentLoaded', function () {
                window.examTracker.onExamComplete();
            });
        }
    </script>
@endpush
