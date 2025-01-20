@props(['options', 'id', 'selected'])
<div>
    <button id="{{ $id }}Button" data-dropdown-toggle="{{ $id }}"
        class="flex items-center justify-between rounded-md border border-input border-gray-300 bg-gray-50 p-3 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 [&>span]:line-clamp-1 w-[180px]"
        type="button">{{ $selected ?? $options[0] }} <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
        </svg>
    </button>

    <!-- Dropdown menu -->
    <div id="{{ $id }}"
        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
            @foreach ($options as $opt)
                <li>
                    <a href="javascript:void(0);" wire:click="setFilter('{{ $id }}', '{{ $opt }}')"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $opt }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
