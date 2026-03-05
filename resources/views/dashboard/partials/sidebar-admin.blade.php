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
            <i class="bi bi-speedometer2 text-lg"></i>
            <span class="font-medium text-sm lg:text-base">Dashboard</span>
        </a>

        <a href="/userulps" class="flex items-center gap-3 px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg hover:bg-blue-700 transition duration-200">
            <i class="bi bi-person-badge text-lg"></i>
            <span class="font-medium text-sm lg:text-base">User ULP</span>
        </a>

        <a href="/tims" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition duration-200 group">
            <i class="bi bi-people-fill text-lg"></i>
            <span class="font-medium">Tim</span>
        </a>

        <a href="/transaksis" class="flex items-center gap-3 px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg hover:bg-blue-700 transition duration-200">
            <i class="bi bi-clipboard-data text-lg"></i>
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
