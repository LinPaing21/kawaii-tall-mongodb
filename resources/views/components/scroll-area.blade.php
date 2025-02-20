@props(['id' => 'none'])

<div dir="ltr" {{ $attributes->merge([ 'class' => "relative overflow-hidden" ])}} style="position: relative; --radix-scroll-area-corner-width: 0px; --radix-scroll-area-corner-height: 0px;">
    <style>[data-radix-scroll-area-viewport]{scrollbar-width:none;-ms-overflow-style:none;-webkit-overflow-scrolling:touch;}[data-radix-scroll-area-viewport]::-webkit-scrollbar{display:none}</style>
    <div data-radix-scroll-area-viewport="" class="h-full w-full rounded-[inherit]" style="overflow: hidden scroll;" id="{{$id}}">
        <div style="min-width: 100%; display: table;">
            {{ $slot }}
        </div>
    </div>
</div>
