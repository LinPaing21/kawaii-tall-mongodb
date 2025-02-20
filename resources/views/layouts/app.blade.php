@extends('layouts.base')

@section('body')
    <div class="flex flex-col min-h-screen bg-gradient-to-b from-red-50 to-white text-gray-800 @yield('home-classes')">
        <x-nav-bar :examParticipate="$examParticipate ?? false"/>

        @yield('content')

        @isset($slot)
            {{ $slot }}
        @endisset

        @hasSection('custom-footer')
            @yield('custom-footer')
        @else
            <x-footer />
        @endif
    </div>
@endsection
