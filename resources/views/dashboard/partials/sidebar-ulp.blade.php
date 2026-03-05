<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
    class="fixed md:static inset-y-0 left-0 z-40 w-64 bg-gradient-to-b from-blue-800 to-blue-950 text-white shadow-xl transform transition-transform duration-300 ease-in-out">

    <!-- Logo Section -->
    <div class="p-6 border-b border-blue-700 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/pln.jpg') }}" alt="Logo PLN" class="w-12 h-12 object-contain bg-white rounded-lg p-1">
            <div>
                <h2 class="text-lg font-bold">UP3 BOGOR</h2>
                <p class="text-blue-300 text-xs">User Panel</p>
            </div>
        </div>
        <!-- Tombol close sidebar di mobile -->
        <button @click="sidebarOpen = false" class="md:hidden text-white focus:outline-none">
            <i class="bi bi-x-lg text-xl"></i>
        </button>
    </div>

    <!-- Navigation Menu -->
    <nav class="p-4 space-y-2">
        <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-700 hover:bg-blue-600 transition duration-200 group">
            <i class="bi bi-speedometer2 text-lg"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <a href="/tims" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition duration-200 group">
            <i class="bi bi-people-fill text-lg"></i>
            <span class="font-medium">Tim</span>
        </a>

        <a href="/transaksis" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition duration-200 group">
            <i class="bi bi-clipboard-data text-lg"></i>
            <span class="font-medium">Transaksi</span>
        </a>
    </nav>

    <!-- User Info Section -->
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-blue-700">
        <div class="flex items-center gap-3 px-4 py-3 bg-blue-900 rounded-lg">
            <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center font-bold text-lg">
                {{ strtoupper(substr(session('username'), 0, 1)) }}
            </div>
            <div class="flex-1">
                <p class="font-semibold text-sm truncate">{{ session('username') }}</p>
                <p class="text-blue-300 text-xs uppercase">{{ session('role') }}</p>
            </div>
        </div>
    </div>
</aside>

<!-- Overlay (buat mobile sidebar) -->
<div @click="sidebarOpen = false"
    x-show="sidebarOpen"
    class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"></div>
