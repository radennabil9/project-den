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

            <!-- Content Area -->
            <div class="p-4 md:p-8 space-y-6">
                <!-- Welcome Card -->
                <div class="bg-gradient-to-r from-emerald-700 to-emerald-900 rounded-xl shadow-lg p-6 md:p-8 text-white border border-emerald-600">
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-2xl md:text-3xl font-bold mb-2">Selamat Datang</h2>
                            <p class="text-emerald-100 text-base md:text-lg mb-1">
                                <span class="font-bold">{{ session('username') }}</span>
                            </p>
                            <p class="text-emerald-200 text-sm">
                                <i class="bi bi-shield-check"></i> Role: 
                                <span class="font-semibold uppercase bg-emerald-800 px-3 py-1 rounded-full">{{ session('role') }}</span>
                            </p>
                            <p class="text-emerald-300 text-sm mt-3">
                                <i class="bi bi-building"></i> Kelola tim dan transaksi PLN UP3 Bogor
                            </p>
                        </div>
                        <div class="hidden md:block">
                            <i class="bi bi-person-circle text-6xl text-emerald-300 opacity-50"></i>
                        </div>
                    </div>
                </div>

                <!-- Quick Menu Section -->
                <div class="bg-white rounded-xl shadow-md p-4 md:p-6 border border-gray-200">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-emerald-100 p-2 rounded-lg">
                            <i class="bi bi-lightning-charge-fill text-emerald-700 text-2xl"></i>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-800">Menu Cepat</h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="/tims" class="group bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-lg p-6 transition duration-200 border border-blue-200 hover:shadow-lg">
                            <div class="flex items-center gap-4">
                                <div class="bg-blue-600 p-3 rounded-lg group-hover:scale-110 transition duration-200">
                                    <i class="bi bi-people-fill text-white text-2xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 group-hover:text-blue-700">Kelola Tim</h4>
                                    <p class="text-sm text-gray-600">Manajemen Tim Kerja</p>
                                </div>
                            </div>
                        </a>

                        <a href="/transaksis" class="group bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 rounded-lg p-6 transition duration-200 border border-purple-200 hover:shadow-lg">
                            <div class="flex items-center gap-4">
                                <div class="bg-purple-600 p-3 rounded-lg group-hover:scale-110 transition duration-200">
                                    <i class="bi bi-clipboard-data text-white text-2xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 group-hover:text-purple-700">Lihat Transaksi</h4>
                                    <p class="text-sm text-gray-600">Data Realisasi KWH</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Filter Laporan -->
                <div class="bg-white rounded-xl shadow-md p-4 lg:p-6 border border-gray-200">
                    <div class="flex items-center gap-3 mb-4">
                        <i class="bi bi-funnel-fill text-emerald-700 text-xl"></i>
                        <h3 class="text-lg font-bold text-gray-800">Filter Laporan Transaksi</h3>
                    </div>
                    <form method="GET" action="{{ route('transaksis.filter') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="bi bi-calendar-date"></i> Tanggal
                            </label>
                            <input type="date" name="tanggal" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="bi bi-calendar-month"></i> Bulan
                            </label>
                            <select name="bulan" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                <option value="">-- Pilih Bulan --</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}">{{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="bi bi-calendar-check"></i> Tahun
                            </label>
                            <select name="tahun" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                <option value="">-- Pilih Tahun --</option>
                                @for ($year = date('Y'); $year >= 2020; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="sm:col-span-3 flex justify-end gap-2">
                            <button type="submit" class="bg-emerald-600 text-white px-5 py-2 rounded-lg hover:bg-emerald-700 transition font-medium shadow-sm">
                                <i class="bi bi-search"></i> Filter
                            </button>
                            <a href="{{ route('dashboard.admin') }}" class="bg-gray-200 text-gray-800 px-5 py-2 rounded-lg hover:bg-gray-300 transition font-medium">
                                <i class="bi bi-arrow-clockwise"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>


                <!-- Table Card -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
                    <div class="bg-gradient-to-r from-emerald-700 to-emerald-900 px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-3">
                        <div class="flex items-center gap-2">
                            <i class="bi bi-table text-white text-xl"></i>
                            <h2 class="text-lg sm:text-xl font-semibold text-white">Data Transaksi Realisasi</h2>
                        </div>
                        <span class="bg-white/20 text-white text-xs sm:text-sm px-3 py-1.5 rounded-full font-medium">
                            <i class="bi bi-list-ol"></i> {{ count($transaksis) }} Transaksi
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-100 border-b-2 border-emerald-600">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">
                                        <i class="bi bi-hash"></i> ID
                                    </th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">
                                        <i class="bi bi-calendar-event"></i> Tanggal
                                    </th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">
                                        <i class="bi bi-people"></i> Tim
                                    </th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700 uppercase tracking-wider">
                                        <i class="bi bi-lightning-charge"></i> Realisasi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse($transaksis as $transaksi)
                                <tr class="hover:bg-emerald-50 transition duration-150">
                                    <td class="px-4 py-3 text-gray-800 font-semibold text-center">{{ $transaksi->id }}</td>
                                    <td class="px-4 py-3">
                                        <p class="text-gray-900 font-semibold">
                                            <i class="bi bi-calendar3 text-emerald-600"></i> 
                                            {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y') }}
                                        </p>
                                        <p class="text-gray-500 text-xs">
                                            <i class="bi bi-clock"></i> 
                                            {{ \Carbon\Carbon::parse($transaksi->tanggal)->diffForHumans() }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-3 text-gray-700 font-medium">{{ $transaksi->tim->nama_regu ?? '-' }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full font-bold text-sm">
                                            <i class="bi bi-lightning-fill"></i>
                                            {{ number_format($transaksi->realisasi_kwh, 0, ',', '.') }} KWH
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-12 text-center text-gray-600">
                                        <i class="bi bi-inbox text-4xl text-gray-400 mb-2"></i>
                                        <p>Belum ada data transaksi.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 text-center sm:text-left text-sm text-gray-600">
                        <i class="bi bi-c-circle"></i> PT PLN (Persero) - Data Realisasi KWH
                    </div>
                </div>
            </div>
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
