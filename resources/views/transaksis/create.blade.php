<?php
if (!session('role') || session('role') !== 'admin' && session('role') !== 'ulp') {
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
    <title>Tambah Transaksi - PLN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-emerald-50 via-white to-blue-50 min-h-screen">
    @include('dashboard.partials.sidebar-feature')
    <div class="feature-content-wrapper w-full px-4 lg:px-8 py-6">
        <!-- Header -->
        <div class="max-w-2xl mx-auto mb-8">
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-600">
                <div class="flex items-center gap-4">
                    <div class="bg-purple-600 text-white p-3 rounded-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Tambah Transaksi</h1>
                        <p class="text-gray-600 text-sm mt-1">Input Realisasi KWH - PT PLN (Persero)</p>
                    </div>
                </div>
            </div>
        </div>

        @if (session('role') === 'admin' || session('role') === 'ulp')
        <!-- Form Card -->
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-8 py-6">
                    <h2 class="text-xl font-semibold text-white">Formulir Input Transaksi</h2>
                    <p class="text-purple-100 text-sm mt-1">Lengkapi data transaksi realisasi KWH dengan benar</p>
                </div>

                <!-- Form Body -->
                <form action="{{ route('transaksis.store') }}" method="POST" class="p-8 space-y-6">
                    @csrf

                    <!-- Info Box -->
                    <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="text-blue-800 font-medium text-sm">Input Transaksi Harian</p>
                                <p class="text-blue-600 text-xs mt-1">Masukkan data realisasi KWH yang telah diselesaikan oleh tim pada tanggal yang dipilih.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            Tanggal <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input 
                                type="date" 
                                name="tanggal" 
                                required
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200 outline-none"
                            >
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Pilih tanggal transaksi realisasi</p>
                    </div>

                    <!-- Pilih Tim -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            Pilih Tim 'Sesuai ULP' <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <select 
                                name="tim_id" 
                                required
                                class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200 outline-none appearance-none bg-white"
                            >
                                <option value="">-- Pilih Tim --</option>
                                @foreach($tims as $tim)
                                <option value="{{ $tim->id }}">{{ $tim->nama_regu }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Pilih tim yang melakukan realisasi</p>
                    </div>

                    <!-- Realisasi KWH -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            Realisasi KWH <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <input 
                                type="number" 
                                name="realisasi_kwh" 
                                id="realisasi_kwh" 
                                step="0.01" 
                                placeholder="Contoh: 1500.50"
                                required
                                class="w-full pl-10 pr-20 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200 outline-none"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 font-medium">KWH</span>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Masukkan jumlah KWH yang direalisasikan (contoh: 1500.50)</p>
                    </div>

                    <!-- Preview KWH Box -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="bg-green-500 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-700">Preview Realisasi</p>
                                    <p class="text-xs text-gray-500">Data yang akan disimpan</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-green-700" id="preview-kwh">0</p>
                                <p class="text-xs text-gray-500">KWH</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tips Box -->
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <p class="text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            Tips Input Data:
                        </p>
                        <ul class="space-y-1 text-xs text-gray-600">
                            <li class="flex items-center gap-2">
                                <svg class="w-3 h-3 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Pastikan tanggal sudah sesuai dengan hari realisasi
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-3 h-3 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Pilih tim yang sesuai dengan yang melakukan pekerjaan
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-3 h-3 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Input angka KWH dengan benar, gunakan titik untuk desimal (contoh: 1500.50)
                            </li>
                        </ul>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-4">
                        <button 
                            type="submit"
                            class="flex-1 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-semibold py-3 px-6 rounded-lg transition duration-200 transform hover:scale-105 shadow-md hover:shadow-lg flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Transaksi
                        </button>
                        
                        <a 
                            href="{{ route('transaksis.index') }}"
                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-lg transition duration-200 flex items-center justify-center gap-2 border border-gray-300"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Batal
                        </a>
                    </div>
                </form>

                <!-- Footer Info -->
                <div class="bg-gray-50 px-8 py-4 border-t border-gray-200">
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        <span>Semua field yang bertanda <span class="text-red-500">*</span> wajib diisi</span>
                    </div>
                </div>
            </div>
        </div>

        @else
        <!-- Access Denied Card -->
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-12 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-red-100 mb-6">
                        <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Akses Ditolak</h3>
                    <p class="text-gray-600 mb-8">Anda tidak memiliki akses untuk menambahkan transaksi. Hanya Admin dan ULP yang dapat melakukan input transaksi.</p>
                    <a 
                        href="{{ route('transaksis.index') }}"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-semibold py-3 px-8 rounded-lg transition duration-200 transform hover:scale-105 shadow-md hover:shadow-lg"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Daftar Transaksi
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>

    <script>
        // Live preview KWH
        const kwhInput = document.getElementById('realisasi_kwh');
        const previewKwh = document.getElementById('preview-kwh');

        if (kwhInput && previewKwh) {
            kwhInput.addEventListener('input', function() {
                const value = parseFloat(this.value) || 0;
                previewKwh.textContent = value.toLocaleString('id-ID', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 2
                });
            });
        }
    </script>
</body>
</html>


