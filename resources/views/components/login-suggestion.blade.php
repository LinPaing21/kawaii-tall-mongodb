<!-- Simple Login Suggestion Modal -->
<div id="loginSuggestionModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-6 text-center text-white">
            <div class="text-3xl mb-2">🎉</div>
            <h2 class="text-xl font-bold mb-1">Great Progress!</h2>
            <p class="text-red-100 text-sm">You've completed your practice tests</p>
        </div>

        <!-- Content -->
        <div class="px-6 py-6">
            <div class="text-center mb-5">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                    Want to supercharge your JLPT prep?
                </h3>
                <p class="text-gray-600 text-sm">
                    Create a free account to see result history, track your progress and unlock more features
                </p>
            </div>

            <!-- Benefits -->
            <div class="space-y-2 mb-6">
                <div class="flex items-center space-x-3">
                    <span class="text-green-500">✓</span>
                    <span class="text-sm text-gray-700">📊 Detailed result history</span>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="text-green-500">✓</span>
                    <span class="text-sm text-gray-700">📈 Progress tracking</span>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="text-green-500">✓</span>
                    <span class="text-sm text-gray-700">♾️ Unlimited practice tests</span>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="text-green-500">✓</span>
                    <span class="text-sm text-gray-700">🎯 Personalized study recommendations</span>
                </div>
            </div>

            <!-- Buttons -->
            <div class="space-y-3">
                <a href="{{ route('register') }}"
                   wire:navigate
                   class="block w-full bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-4 rounded-lg text-center transition-colors">
                    Create Free Account
                </a>
                <a href="{{ route('login') }}"
                   wire:navigate
                   class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-4 rounded-lg text-center transition-colors">
                    Already have an account?
                </a>
            </div>

            <!-- Skip -->
            <div class="text-center mt-4">
                <button onclick="window.closeLoginSuggestion()"
                        class="text-sm text-gray-500 hover:text-gray-700 underline">
                    Maybe later
                </button>
            </div>
        </div>
    </div>
</div>
