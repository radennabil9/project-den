<?php
if (!session('role') || session('role') !== 'admin') {
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
    <title>Data User ULP - PLN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-50 via-white to-sky-50 min-h-screen">
    @include('dashboard.partials.sidebar-feature')
    <div class="container mx-auto px-4 py-8 lg:ml-64">
        <!-- Header -->
        <div class="mb-8">
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-600">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div class="flex items-center gap-4">
                        <!-- Logo PLN -->
                        <img src="{{ asset('assets/pln.jpg') }}" alt="Logo PLN"
                            alt="Logo PLN"
                            class="w-16 h-16 object-contain">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800">Daftar User ULP</h1>
                            <p class="text-gray-600 text-sm mt-1">Unit Layanan Pelanggan - PT PLN (Persero)</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 mb-4">
                        <a href="{{ route('dashboard.admin') }}"
                            class="inline-flex items-center gap-2 bg-white/20 text-blue-700 hover:text-blue-800 px-3 py-2 rounded-lg transition duration-200 shadow-sm hover:shadow-md text-sm font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Kembali
                        </a>

                        <a href="{{ route('userulps.create') }}"
                            class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 transform hover:scale-105 shadow-md hover:shadow-lg flex items-center gap-2 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Tambah User ULP
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-6 bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 shadow-sm animate-pulse">
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-blue-800 font-medium">{{ session('success') }}</p>
            </div>
        </div>
        @endif


        <!-- Table Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Table Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-white">Data User ULP</h2>
                    <span class="bg-white/20 text-white text-sm px-3 py-1 rounded-full">
                        {{ count($userUlps) }} User
                    </span>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b-2 border-blue-600">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama ULP</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Username</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($userUlps as $u)
                        <tr class="hover:bg-blue-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 text-blue-700 font-bold text-sm">
                                    {{ $u->id }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="bg-blue-600 text-white p-2 rounded-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-gray-900 font-semibold">{{ $u->nama_ulp }}</p>
                                        <p class="text-gray-500 text-xs">Unit Layanan Pelanggan</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ $u->username }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('userulps.edit', $u->id) }}"
                                        class="inline-flex items-center gap-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200 text-sm font-medium shadow-sm hover:shadow-md transform hover:scale-105"
                                        title="Edit User">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('userulps.destroy', $u->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Yakin mau hapus user ULP ini? Data yang terkait juga akan terhapus.')"
                                            class="inline-flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200 text-sm font-medium shadow-sm hover:shadow-md transform hover:scale-105"
                                            title="Hapus User">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div class="bg-gray-100 p-4 rounded-full">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 font-medium text-lg">Belum ada data User ULP</p>
                                        <p class="text-gray-500 text-sm mt-1">Klik tombol "Tambah User ULP" untuk menambahkan data</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Table Footer -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between text-sm text-gray-600">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        <span>Kelola akun User ULP untuk sistem manajemen PLN</span>
                    </div>
                    <div class="text-gray-500">
                        © PT PLN (Persero)
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                <div>
                    <p class="text-blue-800 font-medium text-sm">Informasi Penting</p>
                    <p class="text-blue-600 text-xs mt-1">Setiap User ULP memiliki akses ke sistem manajemen tim dan data pelanggan. Pastikan kredensial login disimpan dengan aman.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto hide success message after 5 seconds
        setTimeout(() => {
            const alert = document.querySelector('.animate-pulse');
            if (alert) {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);
    </script>
</body>

</html>