<div>
    {{-- <button type="button" wire:click="handleSave">Save</button> --}}
    <div class="mx-auto bg-gray-100 dark:bg-gray-800 p-5 text-gray-900 dark:text-gray-100" wire:key="page-{{ $page }}">
        <div class="flex justify-between mb-3">
            <button type="button" wire:click="handlePrevious"
                class="px-4 py-1 flex text-gray-900 dark:text-white rounded-lg hover:text-blue-400 dark:hover:text-blue-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
                </svg>
                Previous
            </button>
            <button type="button" wire:click="handleNext"
                class="px-4 py-1 flex text-gray-900 dark:text-white rounded-lg hover:text-blue-400 dark:hover:text-blue-400">
                Next
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>
        <input type="text"
            class="w-full text-2xl font-bold mb-4 text-center border p-2 bg-white dark:bg-gray-700 dark:border-gray-500"
            wire:model="examSections.{{ $page - 1 }}.title" placeholder="Enter Title">
        <input type="text"
            class="w-full text-xl font-bold text-center border p-2 bg-white dark:bg-gray-700 dark:border-gray-500"
            wire:model="examSections.{{ $page - 1 }}.minutes" placeholder="Enter Minutes">

        @php
            $qIndex = 0;
        @endphp
        @foreach ($examSections[$page - 1]['problems'] as $problem)
            <div wire:key="problem-{{ $page }}-{{ $loop->index }}">
                <hr class="my-5 border-gray-300 dark:border-gray-500">
                <h6 class="font-bold grid grid-cols-5 gap-3">
                    <input type="text" class="border p-2 bg-white dark:bg-gray-700 dark:border-gray-500"
                        wire:model="examSections.{{ $page - 1 }}.problems.{{ $loop->index }}.set" placeholder="Problem Set">
                    <input type="text" class="col-span-4 border p-2 bg-white dark:bg-gray-700 dark:border-gray-500"
                        wire:model="examSections.{{ $page - 1 }}.problems.{{ $loop->index }}.problem"
                        placeholder="Problem Description">
                </h6>
                <hr class="my-5 border-gray-300 dark:border-gray-500">
                @isset($problem['example'])
                    <p class="p-2 mb-2 bg-white dark:bg-gray-700">{!! $problem['example']['question'] !!}</p>
                    <input type="text" class="mb-2 border p-2 w-full bg-white dark:bg-gray-700 dark:border-gray-500"
                        wire:model="examSections.{{ $page - 1 }}.problems.{{ $loop->index }}.example.question"
                        placeholder="Example Question">
                    <ul class="flex gap-8">
                        @foreach ($problem['example']['options'] as $e_option)
                            <li wire:key="example-option-{{ $page }}-{{ $loop->parent->index }}-{{ $loop->index }}">
                                <input type="text" class="border p-2 bg-white dark:bg-gray-700 dark:border-gray-500"
                                    wire:model="examSections.{{ $page - 1 }}.problems.{{ $loop->parent->index }}.example.options.{{ $loop->index }}.body"
                                    placeholder="Option Text">
                                <label class="flex items-center gap-1">
                                    <input type="checkbox"
                                        wire:model="examSections.{{ $page - 1 }}.problems.{{ $loop->parent->index }}.example.options.{{ $loop->index }}.is_correct"
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                    Correct
                                </label>
                            </li>
                        @endforeach
                    </ul>
                    <hr class="my-5 border-gray-300 dark:border-gray-500">
                @endisset
            </div>
            @foreach ($problem['questions'] as $question)
                <div class="p-3 rounded-lg mb-6 bg-gray-100 dark:bg-gray-700"
                    id="{{ $examSections[0]['id'] . '-' . $question['no'] }}" wire:key="question-{{ $page }}-{{ $loop->parent->index }}-{{ $loop->index }}">
                    <p class="p-2 mb-2 bg-white dark:bg-gray-700">{!! $question['question'] !!}</p>
                    <input type="text" class="mb-4 border p-2 w-full bg-white dark:bg-gray-700 dark:border-gray-500"
                        wire:model="examSections.{{ $page - 1 }}.problems.{{ $loop->parent->index }}.questions.{{ $loop->index }}.question"
                        placeholder="Question">
                    <div class="space-y-2">
                        @foreach ($question['options'] as $option)
                            <div wire:key="option-{{ $page }}-{{ $loop->parent->parent->index }}-{{ $loop->parent->index }}-{{ $loop->index }}">
                                <input type="text"
                                    class="w-full text-left px-4 py-2 border rounded-md bg-white dark:bg-gray-700 dark:border-gray-500"
                                    wire:model="examSections.{{ $page - 1 }}.problems.{{ $loop->parent->parent->index }}.questions.{{ $loop->parent->index }}.options.{{ $loop->index }}.body"
                                    placeholder="Option Text">
                                <label class="flex items-center gap-1">
                                    <input type="checkbox"
                                        wire:model="examSections.{{ $page - 1 }}.problems.{{ $loop->parent->parent->index }}.questions.{{ $loop->parent->index }}.options.{{ $loop->index }}.is_correct"
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                    Correct
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                @php
                    $qIndex++;
                @endphp
            @endforeach
        @endforeach
    </div>
    <button type="button" x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-4 right-4 w-10 h-10 bg-blue-500 text-white rounded-full shadow-lg hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto w-2/3" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
        </svg>
    </button>
</div>
