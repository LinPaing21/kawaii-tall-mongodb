@extends('layouts.app')

@section('content')
    <main class="flex-1">
        <section
            class="w-full 2xl:w-4/5 2xl:mx-auto 2xl:rounded-b-lg py-12 md:py-24 lg:py-32 bg-tori-gate bg-cover bg-center">
            <div class="container px-4 md:px-6 mx-auto">
                <div class="flex flex-col items-center space-y-4 text-center">
                    <div class="space-y-2 text-white drop-shadow-[0_3px_3px_rgba(44,62,80,0.75)] animate-fade-in">
                        <p
                            class="text-lg text-white/90 font-medium mb-4 bg-black/20 inline-block px-4 py-2 rounded-lg transform hover:scale-105 transition-transform duration-200">
                            {{ __('general.home_head_title') }}
                        </p>
                        <h1 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl lg:text-6xl/none ">
                            {{ __('general.master_jlpt') }}
                        </h1>
                        <p class="mx-auto max-w-[700px] md:text-xl">
                            {{ __('general.home_subtitle') }}
                        </p>
                    </div>
                    <div class="space-x-4">
                        <a href="/exams"
                            class="bg-red-600 hover:bg-red-700 text-white rounded-lg px-6 py-3 font-semibold transition-colors duration-200 shadow-lg">
                            {{ __('general.get_started') }}
                        </a>
                        <button
                            class="bg-white/90 backdrop-blur-sm text-red-600 hover:bg-white hover:text-red-700 rounded-lg px-6 py-3 font-semibold transition-all duration-200 shadow-lg border border-white/20">
                            {{ __('general.learn_more') }}
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full py-12 md:py-24 lg:py-32 ">
            <div class="container px-4 md:px-6 mx-auto">
                <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl text-center mb-12">
                    {{ __('general.choose_jlpt_level') }}
                </h2>
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-5" x-data="{ levels: ['N5', 'N4', 'N3', 'N2', 'N1'] }">
                    <template x-for="level in ['N5', 'N4', 'N3', 'N2', 'N1']" :key="level">
                        <a x-bind:href="'/exams?selectedLevel=' +
                                        level" x-text="level"
                            class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 bg-background hover:text-accent-foreground px-4 py-2 h-32 text-2xl font-bold border-2 border-red-200 hover:border-red-600 hover:bg-red-50 transition-colors">
                        </a>
                    </template>
                </div>
            </div>
        </section>
        <section class="w-full py-12 md:py-24 lg:py-32 bg-red-50">
            <div class="container px-4 md:px-6 mx-auto">
                <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl text-center mb-12">Our
                    Features</h2>
                <div class="grid gap-10 sm:grid-cols-2 md:grid-cols-4">
                    <div class="flex flex-col items-center space-y-3 text-center">
                        <i class="fa-solid fa-graduation-cap h-12 w-12 text-secondary"></i>
                        <h3 class="text-xl font-bold">{{ __('general.comprehensive_lessons') }}</h3>
                        <p class="text-gray-600">
                            Structured lessons covering all aspects of the JLPT exam.
                        </p>
                    </div>
                    <div class="flex flex-col items-center space-y-3 text-center">
                        <i class="fa-solid fa-file-lines h-12 w-12 text-secondary"></i>

                        <h3 class="text-xl font-bold">{{ __('general.pratice_tests') }}</h3>
                        <p class="text-gray-600">
                            Realistic mock exams to gauge your progress and readiness.
                        </p>
                    </div>
                    <div class="flex flex-col items-center space-y-3 text-center">
                        <i class="fa-solid fa-signal h-12 w-12 text-secondary"></i>
                        <h3 class="text-xl font-bold">{{ __('general.progress_tracking') }}</h3>
                        <p class="text-gray-600">
                            Monitor your improvement with detailed performance analytics.
                        </p>
                    </div>
                    <div class="flex flex-col items-center space-y-3 text-center">
                        <i class="fa-solid fa-users h-12 w-12 text-secondary"></i>
                        <h3 class="text-xl font-bold">{{ __('general.community_support') }}</h3>
                        <p class="text-gray-600">
                            Connect with fellow learners and native Japanese speakers.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full py-12 md:py-24 lg:py-32">
            <div class="container px-4 md:px-6 mx-auto">
                <div class="flex flex-col items-center justify-center space-y-4 text-center">
                    <div class="space-y-2">
                        <h2 class="text-3xl font-bold tracking-tighter sm:text-5xl">
                            {{ __('general.ready_to_start') }}
                        </h2>
                        {{-- <p class="max-w-[600px] text-gray-600 md:text-xl">
                            Join thousands of successful students who have passed their JLPT exams with our platform.
                        </p> --}}
                        <p class="max-w-[600px] text-gray-600 md:text-xl">
                            {{ __('general.ready_to_start_subtitle') }}
                        </p>
                    </div>
                    <div class="w-full max-w-sm space-y-2">
                        <form x-data="{ email: '' }" @submit.prevent="
            if (email) {
                window.location.href = '{{ route('register') }}' + '?email=' + encodeURIComponent(email);
            }
        " class="flex space-x-2">
                            <input x-model="email"
                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus:border-gray-500 focus:ring-gray-500 ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 flex-1"
                                placeholder="{{ __('form.enter_your', ['key' => __('form.email')]) }}" type="email"
                                required />
                            <button type="submit"
                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 h-10 px-4 py-2 bg-red-600 hover:bg-red-700 text-white">
                                {{ __('general.sign_up') }}
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
