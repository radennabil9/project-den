@php
    $totalTransaksi = $transaksis->count();
    $totalKwh = $transaksis->sum('realisasi_kwh');
    $avgKwh = $totalTransaksi > 0 ? $totalKwh / $totalTransaksi : 0;
    $totalTim = $tims->count();
    $timAktif = $transaksis->pluck('tim_id')->filter()->unique()->count();
    $timTanpaTransaksi = max($totalTim - $timAktif, 0);
    $persenTimAktif = $totalTim > 0 ? ($timAktif / $totalTim) * 100 : 0;

    $timsById = $tims->keyBy('id');
    $topTimRows = $transaksis
        ->groupBy('tim_id')
        ->map(function ($rows, $timId) use ($timsById) {
            return [
                'nama' => optional($timsById->get($timId))->nama_regu ?? 'Tim Tidak Dikenal',
                'jumlah_transaksi' => $rows->count(),
                'total_kwh' => $rows->sum('realisasi_kwh'),
            ];
        })
        ->sortByDesc('total_kwh')
        ->take(5)
        ->values();

    $months = collect(range(5, 0, -1))
        ->map(fn($i) => \Carbon\Carbon::now()->subMonths($i))
        ->push(\Carbon\Carbon::now())
        ->values();

    $monthRows = $months->map(function ($month) use ($transaksis) {
        $ym = $month->format('Y-m');
        $value = $transaksis
            ->filter(fn($trx) => \Carbon\Carbon::parse($trx->tanggal)->format('Y-m') === $ym)
            ->sum('realisasi_kwh');
        return [
            'label' => $month->format('M y'),
            'value' => $value,
        ];
    });
    $maxMonthly = max($monthRows->max('value') ?? 0, 1);
    $latestTransaksis = $transaksis->sortByDesc('tanggal')->take(8);
@endphp

<div class="p-4 lg:p-8 space-y-6">
    <section class="bg-gradient-to-r from-blue-700 via-blue-800 to-blue-900 rounded-2xl shadow-xl p-6 lg:p-8 text-white border border-blue-600">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-blue-200 text-sm uppercase tracking-widest">Dashboard Analitik</p>
                <h2 class="text-2xl lg:text-3xl font-bold mt-1">{{ $dashboardTitle }}</h2>
                <p class="text-blue-100 mt-2">Ringkasan performa transaksi dan tim kerja secara real-time.</p>
                <div class="mt-4 flex flex-wrap items-center gap-3 text-xs">
                    <span class="bg-white/15 px-3 py-1 rounded-full">User: {{ session('username') }}</span>
                    <span class="bg-white/15 px-3 py-1 rounded-full">Role: {{ strtoupper(session('role')) }}</span>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3 min-w-[220px]">
                <a href="{{ route('tims.index') }}" class="bg-white/10 hover:bg-white/20 transition rounded-xl p-4">
                    <p class="text-xs text-blue-200">Kelola</p>
                    <p class="font-semibold mt-1">Tim</p>
                </a>
                <a href="{{ route('transaksis.index') }}" class="bg-white/10 hover:bg-white/20 transition rounded-xl p-4">
                    <p class="text-xs text-blue-200">Kelola</p>
                    <p class="font-semibold mt-1">Transaksi</p>
                </a>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        <article class="bg-white rounded-2xl p-5 border border-blue-100 shadow-sm">
            <p class="text-xs text-gray-500 uppercase">Total Transaksi</p>
            <p class="text-3xl font-bold text-blue-800 mt-2">{{ number_format($totalTransaksi, 0, ',', '.') }}</p>
        </article>
        <article class="bg-white rounded-2xl p-5 border border-blue-100 shadow-sm">
            <p class="text-xs text-gray-500 uppercase">Total Realisasi</p>
            <p class="text-3xl font-bold text-blue-800 mt-2">{{ number_format($totalKwh, 0, ',', '.') }}</p>
            <p class="text-xs text-gray-500 mt-1">KWH</p>
        </article>
        <article class="bg-white rounded-2xl p-5 border border-blue-100 shadow-sm">
            <p class="text-xs text-gray-500 uppercase">Tim Terdaftar</p>
            <p class="text-3xl font-bold text-blue-800 mt-2">{{ number_format($totalTim, 0, ',', '.') }}</p>
        </article>
        <article class="bg-white rounded-2xl p-5 border border-blue-100 shadow-sm">
            <p class="text-xs text-gray-500 uppercase">Rata-rata / Transaksi</p>
            <p class="text-3xl font-bold text-blue-800 mt-2">{{ number_format($avgKwh, 1, ',', '.') }}</p>
            <p class="text-xs text-gray-500 mt-1">KWH</p>
        </article>
    </section>

    <section class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <article class="xl:col-span-2 bg-white rounded-2xl p-6 border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-800">Diagram Realisasi 6 Bulan Terakhir</h3>
                <span class="text-xs bg-blue-100 text-blue-700 px-3 py-1 rounded-full">KWH</span>
            </div>
            <div class="space-y-4">
                @foreach($monthRows as $row)
                    <div>
                        <div class="flex items-center justify-between text-sm mb-1">
                            <span class="text-gray-600">{{ $row['label'] }}</span>
                            <span class="font-semibold text-gray-800">{{ number_format($row['value'], 0, ',', '.') }}</span>
                        </div>
                        <div class="h-3 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-3 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full" style="width: {{ ($row['value'] / $maxMonthly) * 100 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </article>

        <article class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Status Kelola Tim</h3>
            <div class="space-y-4">
                <div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Tim Aktif</span>
                        <span class="font-semibold text-blue-700">{{ $timAktif }}/{{ $totalTim }}</span>
                    </div>
                    <div class="h-3 bg-gray-100 rounded-full mt-2">
                        <div class="h-3 bg-blue-600 rounded-full" style="width: {{ min(100, $persenTimAktif) }}%"></div>
                    </div>
                </div>
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                    <p class="text-xs text-gray-500 uppercase">Tim Tanpa Transaksi</p>
                    <p class="text-2xl font-bold text-blue-800 mt-1">{{ number_format($timTanpaTransaksi, 0, ',', '.') }}</p>
                </div>
                <div class="bg-cyan-50 border border-cyan-100 rounded-xl p-4">
                    <p class="text-xs text-gray-500 uppercase">Kontribusi Rata-rata Tim</p>
                    <p class="text-2xl font-bold text-cyan-800 mt-1">
                        {{ $totalTim > 0 ? number_format($totalKwh / $totalTim, 1, ',', '.') : '0,0' }} KWH
                    </p>
                </div>
            </div>
        </article>
    </section>

    <section class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        <article class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-blue-700 to-blue-900 text-white flex items-center justify-between">
                <h3 class="font-semibold">Top Tim Berdasarkan KWH</h3>
                <span class="text-xs bg-white/15 px-2 py-1 rounded-full">Top 5</span>
            </div>
            <div class="p-4 space-y-3">
                @forelse($topTimRows as $index => $row)
                    <div class="flex items-center justify-between rounded-xl border border-gray-100 p-3 hover:bg-blue-50 transition">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 text-sm font-bold flex items-center justify-center">{{ $index + 1 }}</span>
                            <div>
                                <p class="font-semibold text-gray-800">{{ $row['nama'] }}</p>
                                <p class="text-xs text-gray-500">{{ $row['jumlah_transaksi'] }} transaksi</p>
                            </div>
                        </div>
                        <p class="font-bold text-blue-700">{{ number_format($row['total_kwh'], 0, ',', '.') }} KWH</p>
                    </div>
                @empty
                    <div class="text-center text-gray-500 py-10">Belum ada data tim dengan transaksi.</div>
                @endforelse
            </div>
        </article>

        <article class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-slate-700 to-slate-900 text-white flex items-center justify-between">
                <h3 class="font-semibold">Transaksi Terbaru</h3>
                <a href="{{ route('transaksis.index') }}" class="text-xs bg-white/15 px-2 py-1 rounded-full hover:bg-white/25">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Tanggal</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Tim</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600">KWH</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($latestTransaksis as $trx)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3 text-gray-700">{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}</td>
                                <td class="px-4 py-3 text-gray-800 font-medium">{{ $trx->tim->nama_regu ?? '-' }}</td>
                                <td class="px-4 py-3 text-right font-semibold text-emerald-700">{{ number_format($trx->realisasi_kwh, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-10 text-center text-gray-500">Belum ada data transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </article>
    </section>

    <section class="bg-white rounded-2xl p-5 border border-gray-200 shadow-sm">
        <p class="text-sm text-gray-600">Filter data dipindahkan ke halaman Transaksi dengan mode rentang tanggal agar analisis laporan lebih fleksibel.</p>
    </section>
</div>
