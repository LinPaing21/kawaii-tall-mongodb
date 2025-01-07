@extends('layouts.base')

@section('body')
    <div class="flex flex-col min-h-screen bg-gradient-to-b from-red-50 to-white text-gray-800">
        <x-nav-bar />

        @yield('content')

        @isset($slot)
            {{ $slot }}
        @endisset
        <x-footer />
    </div>
@endsection
