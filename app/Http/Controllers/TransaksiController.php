<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Tim;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->baseQueryByRole();

        $tanggalDari = $request->query('tanggal_dari');
        $tanggalSampai = $request->query('tanggal_sampai');
        $this->applyDateRangeFilter($query, $tanggalDari, $tanggalSampai);

        $allowedPerPage = [25, 50, 100];
        $perPage = (int) $request->query('per_page', 25);
        if (!in_array($perPage, $allowedPerPage, true)) {
            $perPage = 25;
        }

        $totalTransaksi = (clone $query)->count();
        $totalKwh = (clone $query)->sum('realisasi_kwh');
        $bulanIni = (clone $query)->where('tanggal', '>=', now()->startOfMonth())->count();
        $rataRataKwh = $totalTransaksi > 0 ? ($totalKwh / $totalTransaksi) : 0;

        $transaksis = $query->orderByDesc('tanggal')->paginate($perPage)->withQueryString();

        return view('transaksis.index', compact(
            'transaksis',
            'tanggalDari',
            'tanggalSampai',
            'perPage',
            'totalTransaksi',
            'totalKwh',
            'bulanIni',
            'rataRataKwh'
        ));
    }

    public function filter(Request $request)
    {
        return redirect()->route('transaksis.index', [
            'tanggal_dari' => $request->query('tanggal_dari'),
            'tanggal_sampai' => $request->query('tanggal_sampai'),
            'per_page' => $request->query('per_page', 25),
        ]);
    }

    public function exportExcel(Request $request)
    {
        if (session('role') !== 'admin') {
            abort(403);
        }

        $query = Transaksi::with('tim');
        $tanggalDari = $request->query('tanggal_dari');
        $tanggalSampai = $request->query('tanggal_sampai');
        $this->applyDateRangeFilter($query, $tanggalDari, $tanggalSampai);
        $transaksis = $query->orderByDesc('tanggal')->get();

        $filename = 'laporan_transaksi_' . now()->format('Ymd_His') . '.xls';
        $headers = [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Cache-Control' => 'max-age=0',
        ];

        return response()->streamDownload(function () use ($transaksis) {
            echo "ID\tTanggal\tTim\tRealisasi KWH\n";
            foreach ($transaksis as $transaksi) {
                $row = [
                    $transaksi->id,
                    Carbon::parse($transaksi->tanggal)->format('d-m-Y'),
                    $transaksi->tim->nama_regu ?? '-',
                    number_format((float) $transaksi->realisasi_kwh, 2, '.', ''),
                ];
                echo implode("\t", $row) . "\n";
            }
        }, $filename, $headers);
    }


    public function create()
    {

        // ULP bisa lihat tim miliknya
        if (session('role') === 'ulp') {
            $tims = Tim::where('user_ulp_id', session('ulp_id'))->get();
        } else {
            $tims = Tim::all();
        }

        return view('transaksis.create', compact('tims'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'tanggal' => 'required|date',
            'tim_id' => 'required',
            'realisasi_kwh' => 'required|numeric',
        ]);

        $data = $request->all();
        $data['tanggal'] = Carbon ::parse($request->tanggal)
        ->setTimeFrom(Carbon::now('Asia/Jakarta'));

        Transaksi::create($data);

        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function edit($id)
    {

        $transaksi = Transaksi::findOrFail($id);
        $tims = Tim::all();

        return view('transaksis.edit', compact('transaksi', 'tims'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'tanggal' => 'required|date',
            'tim_id' => 'required',
            'realisasi_kwh' => 'required|numeric',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($request->all());

        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil dihapus!');
    }

    private function baseQueryByRole()
    {
        $query = Transaksi::with('tim');

        if (session('role') !== 'admin') {
            $timIds = Tim::where('user_ulp_id', session('ulp_id'))->pluck('id');
            $query->whereIn('tim_id', $timIds);
        }

        return $query;
    }

    private function applyDateRangeFilter($query, $tanggalDari, $tanggalSampai): void
    {
        if (!empty($tanggalDari)) {
            $query->whereDate('tanggal', '>=', $tanggalDari);
        }

        if (!empty($tanggalSampai)) {
            $query->whereDate('tanggal', '<=', $tanggalSampai);
        }
    }
}
