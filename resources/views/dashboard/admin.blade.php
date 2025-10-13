<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" href="{{ asset('assets/pln_icon.png') }}" type="image/x-icon" width="16" height="16">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - PLN</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
    
        html, body {
            overflow-x: hidden;
        }

        #sidebar {
            max-height: 100vh;
            overflow-y: auto;
        }

        @media (max-width: 640px) {
            h1, h2, h3, h4 {
                font-size: 1rem !important;
            }
            .p-8 {
                padding: 1rem !important;
            }
            .lg\\:p-8 {
                padding: 1rem !important;
            }
            .lg\\:text-xl {
                font-size: 1rem !important;
            }
            .lg\\:text-2xl {
                font-size: 1.25rem !important;
            }
            .lg\\:text-3xl {
                font-size: 1.5rem !important;
            }
            .lg\\:px-8 {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
            .lg\\:py-4 {
                padding-top: 0.75rem !important;
                padding-bottom: 0.75rem !important;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-emerald-700 to-emerald-900 text-white shadow-2xl transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
            <!-- Close Button (Mobile Only) -->
            <button id="closeSidebar" class="lg:hidden absolute top-4 right-4 text-white hover:text-emerald-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Logo Section -->
            <div class="p-4 lg:p-6 border-b border-emerald-600 flex items-center justify-between">
                <div class="flex items-center gap-2 lg:gap-3">
                    <img src="{{ asset('assets/pln.jpg') }}" alt="Logo PLN" class="w-10 h-10 lg:w-12 lg:h-12 object-contain bg-white rounded-lg p-1">
                    <div>
                        <h2 class="text-lg lg:text-xl font-bold">UP3 BOGOR</h2>
                        <p class="text-emerald-200 text-xs">Admin Panel</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="p-3 lg:p-4 space-y-2">
                <a href="/dashboard" class="flex items-center gap-3 px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg bg-emerald-600 hover:bg-emerald-500 transition duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="font-medium text-sm lg:text-base">Dashboard</span>
                </a>

                <a href="/userulps" class="flex items-center gap-3 px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg hover:bg-emerald-800 transition duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="font-medium text-sm lg:text-base">User ULP</span>
                </a>

                <a href="/transaksis" class="flex items-center gap-3 px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg hover:bg-emerald-800 transition duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span class="font-medium text-sm lg:text-base">Transaksi</span>
                </a>
            </nav>

            <!-- User Info -->
            <div class="absolute bottom-0 left-0 right-0 p-3 lg:p-4 border-t border-emerald-600 bg-emerald-800">
                <div class="flex items-center gap-2 lg:gap-3 px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg">
                    <div class="w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-emerald-600 flex items-center justify-center font-bold text-base lg:text-lg flex-shrink-0">
                        {{ strtoupper(substr(session('username'), 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-xs lg:text-sm truncate">{{ session('username') }}</p>
                        <p class="text-emerald-200 text-xs uppercase">{{ session('role') }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Overlay for mobile -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto w-full">
            <header class="bg-white shadow-md sticky top-0 z-10">
                <div class="flex items-center justify-between px-4 lg:px-8 py-3 lg:py-4">
                    <div class="flex items-center gap-3">
                        <button id="menuToggle" class="lg:hidden text-gray-600 hover:text-gray-800 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <div>
                            <h1 class="text-lg sm:text-xl font-bold text-gray-800">Admin</h1>
                            <p class="text-xs sm:text-sm text-gray-600 hidden sm:block">Selamat datang, <span class="font-semibold text-emerald-700">{{ session('username') }}</span></p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-3 py-2 rounded-lg transition duration-200 text-sm lg:text-base">
                            <svg class="w-4 h-4 lg:w-5 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                </div>
            </header>

            <div class="p-4 lg:p-8">
                <!-- Welcome Card -->
                <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 rounded-xl shadow-lg p-5 lg:p-8 mb-6 text-white">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold">Selamat Datang! 👋</h2>
                            <p class="text-sm sm:text-base">Halo <span class="font-bold">{{ session('username') }}</span>! Kamu login sebagai <span class="font-bold uppercase bg-emerald-800 px-2 py-1 rounded-full text-xs sm:text-sm">{{ session('role') }}</span></p>
                        </div>
                        <svg class="hidden sm:block w-20 h-20 text-emerald-500 opacity-20" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z" />
                        </svg>
                    </div>
                </div>

                <!-- Quick Menu -->
                <div class="bg-white rounded-xl shadow-md p-4 lg:p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="bg-emerald-100 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">Menu Cepat</h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <a href="/userulps" class="group bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-lg p-4 transition duration-200 border border-blue-200 hover:shadow-md">
                            <div class="flex items-center gap-3">
                                <div class="bg-blue-500 p-3 rounded-lg group-hover:scale-110 transition duration-200">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 text-sm sm:text-base">Kelola User ULP</h4>
                                    <p class="text-xs text-gray-600">Manajemen User ULP</p>
                                </div>
                            </div>
                        </a>

                        <a href="/transaksis" class="group bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 rounded-lg p-4 transition duration-200 border border-purple-200 hover:shadow-md">
                            <div class="flex items-center gap-3">
                                <div class="bg-purple-500 p-3 rounded-lg group-hover:scale-110 transition duration-200">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 text-sm sm:text-base">Lihat Transaksi</h4>
                                    <p class="text-xs text-gray-600">Data Realisasi KWH</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const closeSidebar = document.getElementById('closeSidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebarFunc() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        menuToggle.addEventListener('click', openSidebar);
        closeSidebar.addEventListener('click', closeSidebarFunc);
        overlay.addEventListener('click', closeSidebarFunc);

        const sidebarLinks = sidebar.querySelectorAll('a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    closeSidebarFunc();
                }
            });
        });
    </script>
</body>
</html>
