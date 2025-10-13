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
    <title>Edit Transaksi - PLN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-emerald-50 via-white to-blue-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="max-w-2xl mx-auto mb-8">
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-600">
                <div class="flex items-center gap-4">
                    <div class="bg-blue-600 text-white p-3 rounded-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Edit Transaksi</h1>
                        <p class="text-gray-600 text-sm mt-1">Update Realisasi KWH - PT PLN (Persero)</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6">
                    <h2 class="text-xl font-semibold text-white">Formulir Update Transaksi</h2>
                    <p class="text-blue-100 text-sm mt-1">Perbarui data transaksi realisasi KWH dengan benar</p>
                </div>

                <!-- Form Body -->
                <form action="{{ route('transaksis.update', $transaksi->id) }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Info Badge -->
                    <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="text-blue-800 font-medium text-sm">Sedang mengedit Transaksi ID: <span class="font-bold">{{ $transaksi->id }}</span></p>
                                <p class="text-blue-600 text-xs mt-1">Pastikan semua perubahan sudah benar sebelum menyimpan.</p>
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
                                value="{{ $transaksi->tanggal }}"
                                required
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 outline-none"
                            >
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Ubah tanggal transaksi jika diperlukan</p>
                    </div>

                    <!-- Pilih Tim -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            Pilih Tim <span class="text-red-500">*</span>
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
                                class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 outline-none appearance-none bg-white"
                            >
                                <option value="">-- Pilih Tim --</option>
                                @foreach($tims as $tim)
                                    <option value="{{ $tim->id }}" {{ $transaksi->tim_id == $tim->id ? 'selected' : '' }}>
                                        {{ $tim->nama_regu }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Tim yang melakukan realisasi</p>
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
                                value="{{ $transaksi->realisasi_kwh }}"
                                step="0.01" 
                                required
                                class="w-full pl-10 pr-20 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 outline-none"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 font-medium">KWH</span>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Update jumlah KWH yang direalisasikan</p>
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
                                <p class="text-2xl font-bold text-green-700" id="preview-kwh">{{ number_format($transaksi->realisasi_kwh, 2, ',', '.') }}</p>
                                <p class="text-xs text-gray-500">KWH</p>
                            </div>
                        </div>
                    </div>

                    <!-- Comparison Box -->
                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-amber-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            <div class="flex-1">
                                <p class="text-amber-800 font-medium text-sm">Data Sebelumnya</p>
                                <div class="mt-2 grid grid-cols-3 gap-4 text-xs">
                                    <div>
                                        <p class="text-amber-600">Tanggal</p>
                                        <p class="font-semibold text-amber-800">{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-amber-600">Tim</p>
                                        <p class="font-semibold text-amber-800">{{ $transaksi->tim->nama_regu ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-amber-600">KWH</p>
                                        <p class="font-semibold text-amber-800">{{ number_format($transaksi->realisasi_kwh, 0, ',', '.') }} KWH</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Warning Box -->
                    <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="text-red-800 font-medium text-sm">Perhatian!</p>
                                <p class="text-red-600 text-xs mt-1">Perubahan data akan langsung tersimpan dan akan mempengaruhi laporan. Pastikan data sudah benar.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-4">
                        <button 
                            type="submit"
                            class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-6 rounded-lg transition duration-200 transform hover:scale-105 shadow-md hover:shadow-lg flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Update Transaksi
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
                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        <span>Field yang bertanda <span class="text-red-500">*</span> wajib diisi</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Link Card -->
        <div class="max-w-2xl mx-auto mt-6">
            <a href="{{ route('transaksis.index') }}" 
               class="flex items-center justify-center gap-2 bg-white hover:bg-gray-50 text-gray-700 font-medium py-3 px-6 rounded-lg shadow-md transition duration-200 border border-gray-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Transaksi
            </a>
        </div>
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