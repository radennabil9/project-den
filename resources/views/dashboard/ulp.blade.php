<?php
if (!session('role') || session('role') !== 'ulp') {
    header('Location: ' . route('login'));
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" href="{{ asset('assets/pln_icon.png') }}" type="image/x-icon" width="16" height="16">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - PLN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100">

    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden" x-cloak>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
               class="fixed md:static inset-y-0 left-0 z-40 w-64 bg-gradient-to-b from-emerald-700 to-emerald-900 text-white shadow-2xl transform transition-transform duration-300 ease-in-out">

            <!-- Logo Section -->
            <div class="p-6 border-b border-emerald-600 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/pln.jpg') }}" alt="Logo PLN" class="w-12 h-12 object-contain bg-white rounded-lg p-1">
                    <div>
                        <h2 class="text-lg font-bold">UP3 BOGOR</h2>
                        <p class="text-emerald-200 text-xs">User Panel</p>
                    </div>
                </div>
                <!-- Tombol close sidebar di mobile -->
                <button @click="sidebarOpen = false" class="md:hidden text-white focus:outline-none">
                    ✕
                </button>
            </div>

            <!-- Navigation Menu -->
            <nav class="p-4 space-y-2">
                <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-emerald-600 hover:bg-emerald-500 transition duration-200 group">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="/tims" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-emerald-800 transition duration-200 group">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="font-medium">Tim</span>
                </a>

                <a href="/transaksis" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-emerald-800 transition duration-200 group">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span class="font-medium">Transaksi</span>
                </a>
            </nav>

            <!-- User Info Section -->
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-emerald-600">
                <div class="flex items-center gap-3 px-4 py-3 bg-emerald-800 rounded-lg">
                    <div class="w-10 h-10 rounded-full bg-emerald-600 flex items-center justify-center font-bold text-lg">
                        {{ strtoupper(substr(session('username'), 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-sm truncate">{{ session('username') }}</p>
                        <p class="text-emerald-200 text-xs uppercase">{{ session('role') }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Overlay (buat mobile sidebar) -->
        <div @click="sidebarOpen = false"
             x-show="sidebarOpen"
             class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"></div>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto md:ml-0">

            <!-- Top Bar -->
            <header class="bg-white shadow-md sticky top-0 z-20">
                <div class="flex items-center justify-between px-4 md:px-8 py-4">
                    <div class="flex items-center gap-3">
                        <!-- Tombol buka sidebar di mobile -->
                        <button @click="sidebarOpen = true" class="md:hidden text-emerald-700 focus:outline-none">
                            ☰
                        </button>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">User</h1>
                            <p class="text-sm text-gray-600">Selamat datang, <span class="font-semibold text-emerald-700">{{ session('username') }}</span></p>
                        </div>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-4 md:px-6 py-2 rounded-lg transition duration-200 shadow-md hover:shadow-lg transform hover:scale-105 text-sm md:text-base">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- Content Area -->
            <div class="p-4 md:p-8 space-y-8">
                <!-- Welcome Card -->
                <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 rounded-xl shadow-lg p-6 md:p-8 text-white">
                    <h2 class="text-2xl md:text-3xl font-bold mb-2">Selamat Datang! 👋</h2>
                    <p class="text-emerald-100 text-base md:text-lg">Halo <span class="font-bold">{{ session('username') }}</span>! Kamu login sebagai
                        <span class="font-bold uppercase bg-emerald-800 px-2 md:px-3 py-1 rounded-full">{{ session('role') }}</span>
                    </p>
                    <p class="text-emerald-200 text-sm mt-3">Kelola tim dan transaksi PLN UP3 Bogor dengan mudah</p>
                </div>

                <!-- Quick Menu Section -->
                <div class="bg-white rounded-xl shadow-md p-4 md:p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-emerald-100 p-2 rounded-lg">
                            <svg class="w-6 h-6 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-800">Menu Cepat</h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="/tims" class="group bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-lg p-6 transition duration-200 border border-blue-200 hover:shadow-md">
                            <div class="flex items-center gap-4">
                                <div class="bg-blue-500 p-3 rounded-lg group-hover:scale-110 transition duration-200">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 group-hover:text-blue-700">Kelola Tim</h4>
                                    <p class="text-sm text-gray-600">Manajemen Tim Kerja</p>
                                </div>
                            </div>
                        </a>

                        <a href="/transaksis" class="group bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 rounded-lg p-6 transition duration-200 border border-purple-200 hover:shadow-md">
                            <div class="flex items-center gap-4">
                                <div class="bg-purple-500 p-3 rounded-lg group-hover:scale-110 transition duration-200">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 group-hover:text-purple-700">Lihat Transaksi</h4>
                                    <p class="text-sm text-gray-600">Data Realisasi KWH</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- AlpineJS buat toggle sidebar -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
