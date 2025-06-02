<div class="max-w-4xl mx-auto bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 p-5">
    <h1 class="text-2xl font-bold mb-4 text-center">Exam Results</h1>

    @foreach ($examResults as $section)
        <div class="mb-6">
            <h2 class="text-xl font-bold underline-offset-1">{{ $section['title'] }}</h2>
            @foreach ($section['problems'] as $problem)
                <h4 class="text-lg italic">{{ $problem['set'] . '. ' . $problem['problem'] }}</h4>
                @foreach ($problem['questions'] as $question)
                    <div class="p-3 rounded-lg mb-4 bg-white text-black dark:bg-black dark:text-white shadow" >
                        {{-- :class="{'!bg-red-300/10': {{ isset($options[(int)@$question['selected'] - 1]) ? $options[(int)@$question['selected'] - 1]['is_correct'] : true }}}" --}}
                        <p class="font-semibold">Q{{ $question['no'] }}: {!! $question['question'] !!}</p>
                        <ul class="mt-2 space-y-2">
                            @foreach ($question['options'] as $option)
                                <li class="flex items-center" :class="{'bg-gray-200 dark:bg-gray-700': {{ @$question['selected'] == $option['no'] }}}">
                                    <span class="mr-2">{{ $option['no'] }}. {{ $option['body'] }}</span>
                                    @if ($option['is_correct'])
                                        {{-- <i class="fa-regular fa-circle-check "></i> --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                          </svg>
                                        @endif
                                    @if (@$question['selected'] == $option['no'] && !$option['is_correct'])
                                        {{-- <i class="fa-regular fa-circle-xmark text-red-500"></i> --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500">
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
</div>
