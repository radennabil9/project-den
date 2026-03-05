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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="bg-gray-50">

    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden" x-cloak>

        @include('dashboard.partials.sidebar-ulp')

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto md:ml-0">

            <!-- Top Bar -->
            <header class="bg-white shadow-sm sticky top-0 z-20 border-b border-gray-200">
                <div class="flex items-center justify-between px-4 md:px-8 py-4">
                    <div class="flex items-center gap-3">
                        <!-- Tombol buka sidebar di mobile -->
                        <button @click="sidebarOpen = true" class="md:hidden text-emerald-700 focus:outline-none">
                            <i class="bi bi-list text-2xl"></i>
                        </button>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">User Dashboard</h1>
                            <p class="text-sm text-gray-600">Selamat datang, <span class="font-semibold text-emerald-700">{{ session('username') }}</span></p>
                        </div>
                    </div>

                    <button type="button" onclick="openLogoutModal()"
                        class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition duration-200 text-sm lg:text-base shadow-sm">
                        <i class="bi bi-box-arrow-right text-lg"></i>
                        <span class="hidden sm:inline">Logout</span>
                    </button>
                </div>

                <!-- Modal Konfirmasi Logout -->
                <div id="logoutModal" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm items-center justify-center z-[9999]">
                    <div class="modal-content bg-white rounded-xl shadow-lg w-80 p-6 text-center transform transition-all duration-200 scale-95 opacity-0">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                            <i class="bi bi-exclamation-triangle text-red-600 text-2xl"></i>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-800 mb-2">Konfirmasi Logout</h2>
                        <p class="text-sm text-gray-500 mb-6">Apakah Anda yakin ingin keluar dari akun ini?</p>

                        <div class="flex justify-center gap-3">
                            <button type="button" onclick="closeLogoutModal()"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg text-sm transition font-medium">
                                Batal
                            </button>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm transition font-medium">
                                    Logout
                                </button>
                            </form>
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

    <script>
    // ===== Modal Logout =====
    const logoutModal = document.getElementById('logoutModal');
    const modalContent = logoutModal.querySelector('.modal-content');

    function openLogoutModal() {
        logoutModal.classList.remove('hidden');
        logoutModal.classList.add('flex');
        document.body.style.overflow = 'hidden';

        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeLogoutModal() {
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            logoutModal.classList.remove('flex');
            logoutModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }, 150);
    }

    // Biar bisa klik di luar modal buat nutup juga
    logoutModal.addEventListener('click', function(e) {
        if (e.target === logoutModal) {
            closeLogoutModal();
        }
    });
</script>

</body>

</html>
