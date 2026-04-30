@section('title', 'Contact Us')

@push('meta')
<meta name="description" content="Have questions or feedback about Kawaii JLPT? Get in touch with our team and we'll get back to you as soon as possible.">
<meta property="og:title" content="Contact Us – Kawaii JLPT">
<meta property="og:description" content="Have questions or feedback? Get in touch with the Kawaii JLPT team.">
<meta property="og:url" content="{{ url('/contact-us') }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="Contact Us – Kawaii JLPT">
<meta name="twitter:description" content="Have questions or feedback? Get in touch with the Kawaii JLPT team.">
@endpush

<div class="max-w-3xl mx-auto px-4 py-12">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Contact Us</h1>
        <p class="text-lg text-gray-600 leading-relaxed">
            Have questions about JLPT preparation or need help with our platform? We're here to help!<br>
            Fill out the form below and we'll get back to you as soon as possible.
        </p>
    </div>

    <!-- Contact Form -->
    <div class="bg-white rounded-lg shadow-sm border p-8 mb-12">
        <h2 class="text-2xl font-semibold text-gray-900 mb-2">Send us a Message</h2>
        <p class="text-gray-600 mb-8">
            Fill out the form below and we'll get back to you as soon as possible.
        </p>

        @session('message')
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('message') }}
            </div>
        @endsession
        <form wire:submit="submit" class="space-y-6">
            @csrf

            <div class="flex items-center justify-between gap-4">
                <!-- Name Field -->
                <div class="w-full">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Name *
                    </label>
                    <input type="text" id="name" name="name" wire:model="name" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                        placeholder="">
                </div>

                <!-- Email Field -->
                <div class="w-full">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email *
                    </label>
                    <input type="email" id="email" name="email" required wire:model="email"
                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                        placeholder="">
                </div>
            </div>

            <!-- Inquiry Type -->
            <div>
                <label for="inquiry_type" class="block text-sm font-medium text-gray-700 mb-2">
                    Inquiry Type *
                </label>
                <select id="inquiry_type" name="inquiry_type" required wire:model="type"
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                    <option value="">Select inquiry type</option>
                    <option value="general">General Question</option>
                    <option value="technical">Technical Support</option>
                    <option value="feedback">Feedback & Suggestions</option>
                    <option value="bug">Report a Bug</option>
                    <option value="content">Content Issues</option>
                    <option value="account">Account Issues</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <!-- Subject -->
            <div>
                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                    Subject *
                </label>
                <input type="text" id="subject" name="subject" required wire:model="subject"
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                    placeholder="">
            </div>

            <!-- Message -->
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                    Message *
                </label>
                <textarea id="message" name="message" rows="6" required wire:model="message"
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors resize-vertical"
                    placeholder=""></textarea>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-md transition-colors duration-200">
                    Send Message
                </button>
            </div>
        </form>
    </div>

    <!-- Contact Methods -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
        <!-- Email Card -->
        <div class="bg-white rounded-lg shadow-sm border p-6 text-center">
            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
            {{-- <h3 class="text-lg font-semibold text-gray-900 mb-2">Email</h3> --}}
            <p class="text-gray-600 text-sm mb-3">Send us an email</p>
            <p class="font-medium text-gray-900 mb-2">plin5757@gmail.com</p>
            <p class="text-sm text-gray-500">⏰ 24/7</p>
        </div>

        <!-- Phone Card -->
        <div class="bg-white rounded-lg shadow-sm border p-6 text-center">
            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                    </path>
                </svg>
            </div>
            {{-- <h3 class="text-lg font-semibold text-gray-900 mb-2">Phone</h3> --}}
            <p class="text-gray-600 text-sm mb-3">Call us directly</p>
            <p class="font-medium text-gray-900 mb-2">+959-766-757-417</p>
            <p class="text-sm text-gray-500">⏰ Mon-Fri 9AM-6PM JST</p>
        </div>
    </div>

    <!-- FAQ Section -->
    {{-- <div class="text-center mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-3">Frequently Asked Questions</h2>
        <p class="text-gray-600 mb-8">
            Before contacting us, you might find your answer in our FAQ section.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#"
                class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 font-medium transition-colors">
                View FAQ
            </a>
            <a href="#"
                class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 font-medium transition-colors">
                Browse Help Center
            </a>
        </div>
    </div> --}}
</div>
