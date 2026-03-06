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
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Navigation Menu -->
    <nav class="p-4 space-y-2">
        <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-700 hover:bg-blue-600 transition duration-200 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 3a9 9 0 0 0-9 9v7a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7a9 9 0 0 0-9-9Zm0 2a7 7 0 0 1 7 7v1h-2.1a5 5 0 1 0-9.8 0H5v-1a7 7 0 0 1 7-7Zm0 6a3 3 0 1 1 0 6 3 3 0 0 1 0-6Z" />
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>

        <a href="/tims" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition duration-200 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2Zm-7 4a3 3 0 1 1-3 3 3 3 0 0 1 3-3Zm5 11H7v-.7c0-1.93 2.69-2.9 5-2.9s5 .97 5 2.9V18Z" />
            </svg>
            <span class="font-medium">Tim</span>
        </a>

        <a href="/transaksis" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition duration-200 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                <path d="M9 2a2 2 0 0 0-2 2v1H6a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V4a2 2 0 0 0-2-2H9Zm0 2h6v1H9V4Zm-1 6h2v8H8v-8Zm3 3h2v5h-2v-5Zm3-5h2v10h-2V8Z" />
            </svg>
            <span class="font-medium">Transaksi</span>
        </a>
    </nav>

    <!-- User Profile + Logout -->
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-blue-700" @click.away="profileOpen = false">
        <button type="button" @click="profileOpen = !profileOpen"
            class="w-full flex items-center gap-3 px-4 py-3 bg-blue-900 rounded-lg hover:bg-blue-800 transition">
            <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center font-bold text-lg">
                {{ strtoupper(substr(session('username'), 0, 1)) }}
            </div>
            <div class="flex-1 text-left">
                <p class="font-semibold text-sm truncate">{{ session('username') }}</p>
                <p class="text-blue-300 text-xs uppercase">{{ session('role') }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-200 transition"
                :class="profileOpen ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
            </svg>
        </button>

        <div x-show="profileOpen" x-transition
            class="mt-2 bg-blue-900 rounded-lg border border-blue-700 overflow-hidden">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full text-left px-4 py-3 text-sm font-medium hover:bg-red-600 transition flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M10 3a1 1 0 0 0-1 1v4a1 1 0 1 0 2 0V5h7v14h-7v-3a1 1 0 1 0-2 0v4a1 1 0 0 0 1 1h8a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-8Zm2.29 5.29a1 1 0 0 0 0 1.42L13.59 11H4a1 1 0 1 0 0 2h9.59l-1.3 1.29a1 1 0 1 0 1.42 1.42l3-3a1 1 0 0 0 0-1.42l-3-3a1 1 0 0 0-1.42 0Z" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Overlay (buat mobile sidebar) -->
<div @click="sidebarOpen = false"
    x-show="sidebarOpen"
    class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"></div>
