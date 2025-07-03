@section('title', 'Result Detail')
@section('home-classes', 'h-screen')
@section('custom-footer')
    <p></p>
@endsection
{{-- @section('home-classes', 'h-screen')
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
@endsection --}}

{{-- <div class="max-w-4xl mx-auto text-gray-900 dark:text-gray-100 p-5" id="content-scrollable"> --}}

    <div class="overflow-y-auto" id="content-scrollable">
        <div class="max-w-4xl mx-auto text-gray-900 dark:text-gray-100 p-5">
            @if (!str_contains(request()->url(), '/admin') && url()->previous() !== request()->fullUrl())
                <x-utilities.back-btn />
            @endif
            <h1 class="text-2xl font-bold mb-4 text-center">Exam Result Details</h1>
            <div class="flex flex-wrap gap-2 mb-4 justify-center">
                @foreach ($examResults as $section)
                    <a href="#{{ $section['id'] }}"
                        class="px-4 py-2 w-32 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition truncate text-center block">
                        {{ $section['title'] }}
                    </a>
                @endforeach
            </div>

            @foreach ($examResults as $section)
                <div class="my-6" id="{{ $section['id'] }}">
                    <h2 class="text-xl font-bold underline underline-offset-8 mb-5"># {{ $section['title'] }} </h2>

                    @if ($section['id'] == 'listening' && !str_contains(request()->url(), '/admin'))
                        <div x-init="initAudio('{{ $result->exam->audio_url }}')">
                            <div class="flex items-center gap-4 mt-3">
                                <button @click="playAudio()"
                                    class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                                    ▶ Start
                                </button>
                                <button @click="pauseAudio()"
                                    class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                                    ⏸ Pause
                                </button>
                                <button @click="stopAudio()"
                                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                    ⏹ Stop
                                </button>
                            </div>

                            <div class="flex items-center gap-2 mt-3">
                                <span id="currentTime" class="text-gray-700 text-sm w-10">0:00</span>
                                <input id="progressBar" type="range" min="0" max="100" value="0" step="0.1"
                                    class="w-full cursor-pointer text-green-500" onchange="seekAudio(event)">
                                <span id="duration" class="text-gray-700 text-sm w-12">0:00</span>
                            </div>
                        </div>
                    @endif

                    @foreach ($section['problems'] as $problem)
                        <h4 class="text-lg italic mt-6 mb-3 whitespace-pre-wrap">{{ $problem['set'] . '. ' . $problem['problem'] }}</h4>
                        @foreach ($problem['questions'] as $question)
                            <div class="p-3 rounded-lg mb-4 bg-black/30 backdrop-blur-md border border-gray-700/50 text-white shadow-lg"
                                :class="{ 'dark:bg-red-500/20 bg-red-800/50': '{{!isset($question['selected']) || !optional(collect($question['options'])->where('no', $question['selected'])->first())['is_correct']}}' }">
                                <p class="font-semibold whitespace-pre-wrap">Q{{ $question['no'] }}: {!! $question['question'] !!}</p>
                                <ul class="mt-2 space-y-2">
                                    @foreach ($question['options'] as $option)
                                        <li class="flex items-center px-2"
                                            :class="{'bg-blue-400/80 dark:bg-blue-400/40': '{{ @$question['selected'] == $option['no'] }}'}">
                                            <span class="mr-2">{{ $option['no'] }}. {!! $option['body'] !!}</span>
                                            @if ($option['is_correct'])
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75"
                                                    stroke="currentColor" class="w-6 h-6 text-green-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                                </svg>
                                            @endif
                                            @if (@$question['selected'] == $option['no'] && !$option['is_correct'])
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75"
                                                    stroke="currentColor" class="w-6 h-6 text-red-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                                </svg>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            @endforeach


            <x-utilities.scroll-up-button scrollableId="content-scrollable" />
        </div>
        @if (!str_contains(request()->url(), '/admin'))
            <x-footer />
        @endif
    </div>
    @push('after-scripts')
        @vite('resources/js/audio.js')
    @endpush
