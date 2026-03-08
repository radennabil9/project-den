<?php
if (!session('role') || (session('role') !== 'admin' && session('role') !== 'ulp')) {
    header('Location: ' . route('login'));
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="icon" href="{{ asset('assets/pln_icon.png') }}" type="image/x-icon" width="16" height="16">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title>Data Transaksi - PLN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-50 via-white to-sky-50 min-h-screen">
    @include('dashboard.partials.sidebar-feature')
    <div class="feature-content-wrapper w-full px-4 lg:px-8 py-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-600">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 flex-wrap">
                    <div class="flex items-center gap-4 flex-wrap justify-center sm:justify-start">
                        <img src="{{ asset('assets/pln.jpg') }}"
                            alt="Logo PLN"
                            class="w-14 h-14 object-contain">
                        <div class="text-center sm:text-left">
                            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Daftar Transaksi</h1>
                            <p class="text-gray-600 text-sm mt-1">Realisasi KWH - PT PLN (Persero)</p>
                        </div>
                    </div>

	                    <div class="flex flex-wrap justify-center sm:justify-end gap-2">
                        @if (session('role') === 'admin')
                        <a href="{{ route('dashboard.admin') }}"
                            class="inline-flex items-center gap-2 bg-white/20 text-blue-600 hover:text-blue-800 px-3 py-2 rounded-lg transition duration-200 shadow-sm hover:shadow-md text-sm font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Kembali
                        </a>
                        @else
                        <a href="{{ route('dashboard.ulp') }}"
                            class="inline-flex items-center gap-2 bg-white/20 text-blue-600 hover:text-blue-800 px-3 py-2 rounded-lg transition duration-200 shadow-sm hover:shadow-md text-sm font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Kembali
                        </a>
                        @endif

	                        <a href="{{ route('transaksis.create') }}"
	                            class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2 px-3 rounded-lg transition duration-200 transform hover:scale-105 shadow-md hover:shadow-lg text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
	                            Tambah
	                        </a>
	                    </div>
	                </div>
	            </div>
	        </div>

	        <!-- Filter Rentang Tanggal -->
	        <div class="mb-8 bg-white rounded-xl shadow-md p-5 border border-gray-200">
	            <div class="flex flex-col xl:flex-row xl:items-end gap-4">
	                <form method="GET" action="{{ route('transaksis.index') }}" class="flex-1 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-3 items-end">
	                    <div>
	                        <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wider">Tanggal Dari</label>
	                        <input type="date" name="tanggal_dari" value="{{ $tanggalDari ?? request('tanggal_dari') }}"
	                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
	                    </div>
	                    <div>
	                        <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wider">Tanggal Sampai</label>
	                        <input type="date" name="tanggal_sampai" value="{{ $tanggalSampai ?? request('tanggal_sampai') }}"
	                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
	                    </div>
	                    <button type="submit"
	                        class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg px-4 py-2.5 text-sm font-semibold shadow-sm h-[44px]">
	                        Filter
	                    </button>
	                    <a href="{{ route('transaksis.index') }}"
	                        class="inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg px-4 py-2.5 text-sm font-semibold border border-gray-300 h-[44px]">
	                        Reset
	                    </a>
	                </form>

	                @if (session('role') === 'admin')
	                <a href="{{ route('transaksis.export', ['tanggal_dari' => $tanggalDari ?? request('tanggal_dari'), 'tanggal_sampai' => $tanggalSampai ?? request('tanggal_sampai')]) }}"
	                    class="inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg px-4 py-2.5 text-sm font-semibold shadow-sm whitespace-nowrap h-[44px]">
	                    Export Excel
	                </a>
	                @endif
	            </div>
	            <p class="text-xs text-gray-500 mt-3">Contoh: tanggal 1 Desember 2025 sampai tanggal 30 Januari 2026.</p>
	        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-3">
                <h2 class="text-lg sm:text-xl font-semibold text-white">Data Transaksi Realisasi</h2>
                <span class="bg-white/20 text-white text-xs sm:text-sm px-3 py-1 rounded-full">
                    {{ count($transaksis) }} Transaksi
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 border-b-2 border-blue-600">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">Tanggal</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">Tim</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700 uppercase tracking-wider">Realisasi</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($transaksis as $transaksi)
                        <tr class="hover:bg-blue-50 transition duration-150">
                            <td class="px-4 py-3 text-gray-800 font-semibold text-center">{{ $transaksi->id }}</td>
                            <td class="px-4 py-3">
                                <p class="text-gray-900 font-semibold">{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y') }}</p>
                                <p class="text-gray-500 text-xs">{{ \Carbon\Carbon::parse($transaksi->tanggal)->diffForHumans() }}</p>
                            </td>
                            <td class="px-4 py-3 text-gray-700">{{ $transaksi->tim->nama_regu ?? '-' }}</td>
                            <td class="px-4 py-3 text-center text-green-700 font-bold">
                                {{ number_format($transaksi->realisasi_kwh, 0, ',', '.') }} KWH
                            </td>
                            <td class="px-4 py-3 text-center flex flex-wrap justify-center gap-2">
                                <a href="{{ route('transaksis.edit', $transaksi->id) }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-xs sm:text-sm font-medium shadow-sm hover:shadow-md">
                                    Edit
                                </a>
                                <form action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus transaksi ini?')"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-xs sm:text-sm font-medium shadow-sm hover:shadow-md">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-12 text-center text-gray-600">Belum ada data transaksi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 text-center sm:text-left text-sm text-gray-600">
                © PT PLN (Persero) UP3 BOGOR - Data Realisasi KWH
            </div>
        </div>

        <!-- Info -->
        <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4">
            <p class="text-blue-800 font-medium text-sm mb-1">Informasi</p>
            <p class="text-blue-600 text-xs">Data transaksi mencatat realisasi KWH tiap tim. Pastikan input akurat.</p>
        </div>
    </div>
</body>
</html>


