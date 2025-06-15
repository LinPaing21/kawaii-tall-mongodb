@props(['scrollableId'])
{{--
<button
    x-on:click="document.querySelector('#{{ $scrollableId }}').scrollTo({ top: 0, behavior: 'smooth' })"
    >
    <i class="fa-solid fa-arrow-up"></i>
</button> --}}

{{-- In your components/utilities/scroll-up-button.blade.php --}}
<button
    x-on:click="document.querySelector('#{{ $scrollableId }}').scrollTo({ top: 0, behavior: 'smooth' })"
    {{ $attributes->merge(['class' => 'fixed bottom-4 right-4 w-10 h-10 bg-blue-500 text-white rounded-full shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 hidden']) }}
    id="scroll-up-button"
>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
    </svg>
</button>

<script>
    // Add this to your resources/js/audio.js or create a new JS file
    document.addEventListener('DOMContentLoaded', function() {
        const scrollable = document.getElementById('{{$scrollableId}}');
        const scrollButton = document.getElementById('scroll-up-button'); // Adjust selector as needed

        scrollable.addEventListener('scroll', function() {
            if (scrollable.scrollTop > 200) {
                scrollButton.classList.remove('hidden');
            } else {
                scrollButton.classList.add('hidden');
            }
        });
    });
</script>
