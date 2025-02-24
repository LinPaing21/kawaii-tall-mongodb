<div>
    <div class="relative mt-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center text-sm leading-5">
            <span class="px-2 bg-white text-gray-500">
                Or continue with
            </span>
        </div>
    </div>
    <div class="mt-6">
        <span class="block w-full rounded-md shadow-sm">
            <a href="{{ route('auth.google.redirect') }}"
                class="flex justify-center items-center w-full px-4 py-2 text-sm font-medium text-black bg-white border border-blue-300 rounded-md hover:bg-gray-100 focus:outline-none focus:border-blue-700 focus:ring-indigo active:bg-blue-700 transition duration-150 ease-in-out">
                <i class="fa-brands fa-google me-3"></i> Google
            </a>
        </span>
    </div>
</div>
