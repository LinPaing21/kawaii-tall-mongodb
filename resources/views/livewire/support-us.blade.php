@section('title', 'Support Us')

@push('meta')
<meta name="description" content="Enjoy free JLPT practice exams? Support Kawaii JLPT to help keep the platform free and growing for Japanese learners worldwide.">
<meta property="og:title" content="Support Kawaii JLPT – Help Us Stay Free">
<meta property="og:description" content="Enjoy free JLPT practice exams? Support us to help keep the platform free and growing.">
<meta property="og:url" content="{{ url('/support-us') }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="Support Kawaii JLPT – Help Us Stay Free">
<meta name="twitter:description" content="Enjoy free JLPT practice exams? Support us to help keep the platform free and growing.">
@endpush
{{-- MAIN --}}
<main class="container mx-auto px-4 py-8" x-data="{
        selectedAmount: @entangle('selectedAmount'),
        select(amount) {
            this.selectedAmount = amount;
            $wire.emit('selectAmountFromAlpine', amount);
        }
    }">
    {{-- Hero --}}
    <div class="text-center mb-12">
        <div class="text-6xl mb-4">🌸</div>
        <h1 class="text-4xl font-bold mb-4 text-gray-800">Support JLPT Master</h1>
        <div class="text-2xl font-medium text-pink-600 mb-6">
            "Kawaii is free and will always be"
        </div>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
            We believe learning Japanese should be accessible to everyone...
        </p>
    </div>

    {{-- Impact Stats --}}
    <div class="grid gap-6 md:grid-cols-3 mb-12">
        @foreach($impactStats as $stat)
            <div class="bg-white border rounded-lg p-6 text-center shadow-sm">
                <div class="text-red-600 flex justify-center mb-2 text-2xl">{{ $stat['icon'] }}</div>
                <div class="text-2xl font-bold text-gray-800 mb-1">{{ $stat['number'] }}</div>
                <div class="text-sm text-gray-600">{{ $stat['label'] }}</div>
            </div>
        @endforeach
    </div>

    {{-- Donation Tiers --}}
    {{-- <h2 class="text-3xl font-bold text-center mb-8">Choose Your Support Level</h2>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 mb-12">
        @foreach($donationTiers as $tier)
        <div class="border rounded-lg transition-all p-4 text-center hover:shadow-lg">
            <div class="text-red-600 text-3xl mb-2">{{ $tier['icon'] }}</div>
            <h3 class="text-xl font-bold">{{ $tier['title'] }}</h3>
            <div class="text-3xl font-bold text-red-600">{{ $tier['amount'] }} Ks</div>
            <p class="text-gray-600">{{ $tier['description'] }}</p>
            <ul class="mt-4 space-y-2 text-sm">
                @foreach($tier['perks'] as $perk)
                <li class="flex items-center justify-center text-pink-500">❤️ {{ $perk }}</li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </div> --}}

    {{-- Support Form + QR Code --}}
    {{-- <div class="grid gap-6 md:grid-cols-2 items-start mb-12">

        Form
        <div class="bg-white border rounded-lg shadow-sm p-6">
            <h3 class="flex items-center text-xl font-bold mb-4">🎁 Send Your Support</h3>

            @if (session()->has('message'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('message') }}
            </div>
            @endif

            <form wire:submit.prevent="submitSupport" class="space-y-4">
                Name
                <div>
                    <label class="block text-sm font-medium mb-1">Your Name</label>
                    <input type="text" wire:model="supportName" class="w-full border rounded px-3 py-2"
                        placeholder="e.g. John Doe">
                    @error('supportName') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                Email
                <div>
                    <label class="block text-sm font-medium mb-1">Your Email (optional)</label>
                    <input type="email" wire:model="email" class="w-full border rounded px-3 py-2"
                        placeholder="e.g. johndoe@gmail.com">
                    @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                Amount
                <div>
                    <label class="block text-sm font-medium mb-1">Amount (Ks)</label>
                    <input type="number" wire:model="supportAmount" min="2000" class="w-full border rounded px-3 py-2"
                        placeholder="e.g. 2,000">
                    @error('supportAmount') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                Name
                <div>
                    <label class="block text-sm font-medium mb-1">Note</label>
                    <textarea wire:model="note" class="w-full border rounded px-3 py-2 h-24"
                        placeholder="e.g. Note (optional)"></textarea>
                    @error('note') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                Screenshot
                <div>
                    <label class="block text-sm font-medium mb-1">Payment Screenshot</label>
                    <input type="file" wire:model="screenshot" accept="image/*" class="w-full border rounded px-3 py-2">
                    @error('screenshot') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

                    Preview
                    @if ($screenshot)
                    <div class="mt-2">
                        <img src="{{ $screenshot->temporaryUrl() }}" class="max-h-40 rounded border">
                    </div>
                    @endif
                </div>

                Submit
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded">
                    Submit Support
                </button>
            </form>
        </div>

        QR Code
        <div class="bg-white border rounded-lg shadow-sm p-6 flex flex-col items-center justify-center">
            <h3 class="text-xl font-bold mb-2">📱 Scan to Pay</h3>
            <p class="text-gray-600 mb-4">Use this QR code to send your donation</p>
            <div class="lg:flex">
                <a href="{{ asset('assets/images/kbzpay.jpg') }}" target="blank"><img
                        src="{{ asset('assets/images/kbzpay.jpg') }}" alt="QR Code"
                        class="m-2 lg:m-7 w-60 h-60 border rounded shadow"></a>
                <a href="{{ asset('assets/images/wavemoney.jpg') }}" target="blank"><img
                        src="{{ asset('assets/images/wavemoney.jpg') }}" alt="QR Code"
                        class="m2 lg:m-7 w-60 h-60 border rounded shadow"></a>
            </div>
            <p class="text-lg">NYAN LIN PAING</p>
            <p class="text-md">09******417</p>
            <p class="text-sm text-gray-500 mt-2">After payment, please upload a screenshot in the form.</p>
        </div>
    </div> --}}

    {{-- Why Support --}}
    <div class="mb-12 bg-white border rounded-lg p-6">
        <h3 class="text-center text-2xl font-bold mb-6">Why Your Support Matters</h3>
        <div class="grid gap-6 md:grid-cols-3 text-center">
            <div>
                <div class="text-4xl mb-3">🚀</div>
                <h4 class="font-semibold mb-2">Keep Improving</h4>
                <p class="text-sm text-gray-600">Your donations help us add new features...</p>
            </div>
            <div>
                <div class="text-4xl mb-3">🌍</div>
                <h4 class="font-semibold mb-2">Stay Free</h4>
                <p class="text-sm text-gray-600">We're committed to keeping Kawaii JLPT free...</p>
            </div>
            <div>
                <div class="text-4xl mb-3">💝</div>
                <h4 class="font-semibold mb-2">Community Driven</h4>
                <p class="text-sm text-gray-600">Every donation helps maintain our community...</p>
            </div>
        </div>
    </div>

    {{-- Alternative Support --}}
    <div class="text-center">
        <div class="bg-white border rounded-lg p-6">
            <h3 class="text-xl font-bold">Other Ways to Support</h3>
            <p class="text-gray-600 mb-4">Can't donate? You can still help!</p>
            <div class="flex flex-wrap justify-center gap-4">
                <button class="border rounded px-4 py-2" x-data @click="$dispatch('open-share-popup', {
                        url: '{{ url()->current() }}',
                        title: 'My Page Title',
                        image: '{{ asset('images/share.jpg') }}'
                    })">
                    Share with Friends
                </button>
                <a href="{{ route('contact-us') }}" class="border rounded px-4 py-2">Leave a Review</a>
                <button class="border rounded px-4 py-2">Follow on Social Media</button>
                <a href="{{ route('contact-us') }}" class="border rounded px-4 py-2" wire:navigate>Report Bugs</a>
            </div>
        </div>
    </div>

    @livewire('components.share-popup', [
        'url' => config('app.url'),
        'title' => "\n\nStudying for the JLPT? I've been using this free practice website and it's great. Thought you might find it useful too.`` \n\nJLPT အတွက် စာကျက်နေလား။ ငါ ဒီအခမဲ့ practice website ကို သုံးနေတာ အဆင်ပြေတယ်။ မင်းလည်း အသုံးဝင်မယ်ထင်လို့။`` \n\nJLPTの勉強してる？この無料練習サイト、すごくいいよ。君にも役立つと思って。``\n"
    ])
    </main>
