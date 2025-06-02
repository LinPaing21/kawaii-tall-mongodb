<div class="p-4 text-sm bg-{{ $type === 'success' ? 'green-500' : ($type === 'error' ? 'red-500' : 'yellow-500') }} rounded-lg" role="alert">
    {{ $slot }}
</div>
