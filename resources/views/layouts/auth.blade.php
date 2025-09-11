@extends('layouts.base')

@section('body')
    <div class="flex flex-col justify-center min-h-screen py-12 bg-gradient-to-b from-red-100 to-white sm:px-6 lg:px-8">
        @yield('content')

        @isset($slot)
            {{ $slot }}
        @endisset
    </div>
@endsection
