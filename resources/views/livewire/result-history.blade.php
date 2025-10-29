<div class="min-h-screen bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 py-6">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex gap-4 items-center mb-2">
                <x-utilities.back-btn />
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Exam Result History</h1>
            </div>
            <p class="text-gray-600">Track your JLPT learning progress and performance</p>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg p-4 shadow-sm border">
                <div class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</div>
                <div class="text-sm text-gray-600">Total Exams</div>
            </div>
            <div class="bg-white rounded-lg p-4 shadow-sm border">
                <div class="text-2xl font-bold text-green-600">{{ $stats['passed'] }}</div>
                <div class="text-sm text-gray-600">Passed</div>
            </div>
            <div class="bg-white rounded-lg p-4 shadow-sm border">
                <div class="text-2xl font-bold text-blue-600">{{ number_format($stats['average'], 1) }}%</div>
                <div class="text-sm text-gray-600">Average Score</div>
            </div>
            <div class="bg-white rounded-lg p-4 shadow-sm border">
                <div class="text-2xl font-bold text-red-600">{{ $stats['best'] }}%</div>
                <div class="text-sm text-gray-600">Best Score</div>
            </div>
        </div>

        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6" role="alert">
            <p class="font-bold">Information</p>
            <p>Results from practice mode exams are not saved in your result history.</p>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg p-4 shadow-sm border mb-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Level</label>
                    <select wire:model.change="selectedLevel" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                        <option value="all">All Levels</option>
                        <option value="N5">N5</option>
                        <option value="N4">N4</option>
                        <option value="N3">N3</option>
                        <option value="N2">N2</option>
                        <option value="N1">N1</option>
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Result</label>
                    <select wire:model.change="selectedStatus" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                        <option value="all">All Results</option>
                        <option value="passed">Passed Only</option>
                        <option value="failed">Failed Only</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Results List -->
        <div class="space-y-4">
            @forelse($results as $result)
                <div class="bg-white rounded-lg shadow-sm border hover:shadow-md transition-shadow duration-200">
                    <div class="p-4 md:p-6">
                        <!-- Mobile Layout -->
                        <div class="block md:hidden">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            {{ $result->exam->level }}
                                        </span>
                                        @if($result->passed)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Passed
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Failed
                                            </span>
                                        @endif
                                    </div>
                                    <h3 class="font-medium text-gray-900">{{ $result->exam->title }}</h3>
                                    <p class="text-sm text-gray-500">{{ $result->created_at->format('M j, Y') }}</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-bold {{ app(App\Services\ResultService::class)->getOverAllPercentage($result['results']) >= 80 ? 'text-green-600' : (app(App\Services\ResultService::class)->getOverAllPercentage($result['results']) >= 50 ? 'text-yellow-600' : 'text-red-600') }}">
                                        {{ app(App\Services\ResultService::class)->getOverAllPercentage($result['results']) }}%
                                    </div>
                                </div>
                            </div>

                            <!-- Section Scores (Mobile) -->
                            @if($result['results'])
                                <div class="space-y-2 mb-3">
                                    @foreach($result['results'] as $section)
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">
                                                @switch($section)
                                                    @case('vocabulary')
                                                        Vocabulary
                                                        @break
                                                    @case('grammar')
                                                        Grammar
                                                        @break
                                                    @case('listening')
                                                        Listening
                                                        @break
                                                    @default
                                                        {{ ucfirst($section['id']) }}
                                                @endswitch
                                            </span>
                                            <span class="text-sm font-medium">{{ app(App\Services\ResultService::class)->getSectionalPercentage($section) }}%</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="flex justify-between items-center text-sm text-gray-500">
                                {{-- <span>Time: {{ $result->time_spent ?? 'N/A' }}</span> --}}
                                <button class="text-red-600 hover:text-red-700 font-medium" wire:click="viewDetail('{{ $result->id }}')">View Details</button>
                            </div>
                        </div>

                        <!-- Desktop Layout -->
                        <div class="hidden md:block">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div>
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                {{ $result->exam->level }}
                                            </span>
                                            @if($result->passed)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Passed
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Failed
                                                </span>
                                            @endif
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900">{{ $result->exam->title }}</h3>
                                        <p class="text-sm text-gray-500">{{ $result->created_at->format('M j, Y g:i A') }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-6">
                                    <!-- Section Scores (Desktop) -->
                                    @if($result['results'])
                                        <div class="flex space-x-4">
                                            @foreach($result['results'] as $section)
                                                <div class="text-center">
                                                    <div class="text-sm font-medium {{ app(App\Services\ResultService::class)->getSectionalPercentage($section) >= 64 ? 'text-green-600' : (app(App\Services\ResultService::class)->getSectionalPercentage($section) >= 32 ? 'text-yellow-600' : 'text-red-600') }}">
                                                        {{ app(App\Services\ResultService::class)->getSectionalPercentage($section) }}%
                                                    </div>
                                                    <div class="text-xs text-gray-500">
                                                        @switch($section)
                                                            @case('vocabulary')
                                                                Vocab
                                                                @break
                                                            @case('grammar')
                                                                Grammar
                                                                @break
                                                            @case('listening')
                                                                Listening
                                                                @break
                                                            @default
                                                                {{ ucfirst($section['id']) }}
                                                        @endswitch
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <!-- Total Score -->
                                    <div class="text-center">
                                        <div class="text-3xl font-bold {{ app(App\Services\ResultService::class)->getOverAllPercentage($result['results']) >= 80 ? 'text-green-600' : (app(App\Services\ResultService::class)->getOverAllPercentage($result['results']) >= 50 ? 'text-yellow-600' : 'text-red-600') }}">
                                            {{ app(App\Services\ResultService::class)->getOverAllPercentage($result['results']) }}%
                                        </div>
                                        <div class="text-xs text-gray-500">Total</div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex items-center space-x-2">
                                        {{-- <span class="text-sm text-gray-500">{{ $result->time_spent ?? 'N/A' }}</span> --}}
                                        <button class="px-3 py-1 text-sm text-red-600 hover:text-red-700 hover:bg-red-50 rounded-md transition-colors" wire:click="viewDetail('{{ $result->id }}')">
                                            Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-lg shadow-sm border p-8 text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No exam results yet</h3>
                    <p class="text-gray-500 mb-4">Take a practice test to see your results and track your progress!</p>
                    <a href="{{ route('exam-selection') }}" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md transition-colors">
                        Take a Practice Test
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($results->hasPages())
            <div class="mt-6">
                {{ $results->links() }}
            </div>
        @endif
    </div>
</div>
