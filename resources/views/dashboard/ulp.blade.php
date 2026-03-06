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

<body class="bg-gray-50">

    <div x-data="{ sidebarOpen: false, profileOpen: false }" class="flex h-screen overflow-hidden" x-cloak>

        @include('dashboard.partials.sidebar-ulp')

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto md:ml-0">

            <!-- Top Bar -->
            <header class="bg-white shadow-sm sticky top-0 z-20 border-b border-gray-200">
                <div class="flex items-center justify-between px-4 md:px-8 py-4">
                    <div class="flex items-center gap-3">
                        <!-- Tombol buka sidebar di mobile -->
                        <button @click="sidebarOpen = true" class="md:hidden text-blue-700 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">User Dashboard</h1>
                            <p class="text-sm text-gray-600">Selamat datang, <span class="font-semibold text-blue-700">{{ session('username') }}</span></p>
                        </div>
                    </div>
                </div>
            </header>

            @include('dashboard.partials.insight-content', [
                'dashboardTitle' => 'ULP Dashboard',
                'resetRoute' => route('dashboard.ulp'),
            ])
        </main>
    </div>

    <!-- AlpineJS buat toggle sidebar -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</body>

</html>
