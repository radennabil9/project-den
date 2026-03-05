<aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-blue-800 to-blue-950 text-white shadow-xl transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    <!-- Close Button (Mobile Only) -->
    <button id="closeSidebar" class="lg:hidden absolute top-4 right-4 text-white hover:text-blue-200">
        <i class="bi bi-x-lg text-xl"></i>
    </button>

    <!-- Logo Section -->
    <div class="p-4 lg:p-6 border-b border-blue-700 flex items-center justify-between">
        <div class="flex items-center gap-2 lg:gap-3">
            <img src="{{ asset('assets/pln.jpg') }}" alt="Logo PLN" class="w-10 h-10 lg:w-12 lg:h-12 object-contain bg-white rounded-lg p-1">
            <div>
                <h2 class="text-lg lg:text-xl font-bold">UP3 BOGOR</h2>
                <p class="text-blue-300 text-xs">Admin Panel</p>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="p-3 lg:p-4 space-y-2">
        <a href="/dashboard" class="flex items-center gap-3 px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg bg-blue-700 hover:bg-blue-600 transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 3a9 9 0 0 0-9 9v7a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7a9 9 0 0 0-9-9Zm0 2a7 7 0 0 1 7 7v1h-2.1a5 5 0 1 0-9.8 0H5v-1a7 7 0 0 1 7-7Zm0 6a3 3 0 1 1 0 6 3 3 0 0 1 0-6Z" />
            </svg>
            <span class="font-medium text-sm lg:text-base">Dashboard</span>
        </a>

        <a href="/userulps" class="flex items-center gap-3 px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg hover:bg-blue-700 transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                <path d="M16 11a4 4 0 1 0-3.999-4A4 4 0 0 0 16 11Zm-8 0a3 3 0 1 0-3-3 3 3 0 0 0 3 3Zm8 2c-2.7 0-8 1.35-8 4v2h16v-2c0-2.65-5.3-4-8-4Zm-8 0c-.39 0-.82.03-1.27.08C4.78 13.35 2 14.28 2 16v2h4v-1c0-1.23.68-2.29 1.86-3.09A9.6 9.6 0 0 1 8 13Z" />
            </svg>
            <span class="font-medium text-sm lg:text-base">User ULP</span>
        </a>

        <a href="/tims" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition duration-200 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2Zm-7 4a3 3 0 1 1-3 3 3 3 0 0 1 3-3Zm5 11H7v-.7c0-1.93 2.69-2.9 5-2.9s5 .97 5 2.9V18Z" />
            </svg>
            <span class="font-medium">Tim</span>
        </a>

        <a href="/transaksis" class="flex items-center gap-3 px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg hover:bg-blue-700 transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                <path d="M9 2a2 2 0 0 0-2 2v1H6a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V4a2 2 0 0 0-2-2H9Zm0 2h6v1H9V4Zm-1 6h2v8H8v-8Zm3 3h2v5h-2v-5Zm3-5h2v10h-2V8Z" />
            </svg>
            <span class="font-medium text-sm lg:text-base">Transaksi</span>
        </a>
    </nav>

    <!-- User Info -->
    <div class="absolute bottom-0 left-0 right-0 p-3 lg:p-4 border-t border-blue-700 bg-blue-900">
        <div class="flex items-center gap-2 lg:gap-3 px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg">
            <div class="w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-blue-600 flex items-center justify-center font-bold text-base lg:text-lg flex-shrink-0">
                {{ strtoupper(substr(session('username'), 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-xs lg:text-sm truncate">{{ session('username') }}</p>
                <p class="text-blue-300 text-xs uppercase">{{ session('role') }}</p>
            </div>
        </div>
    </div>
</aside>

<!-- Overlay for mobile -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>
