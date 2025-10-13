<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Tim;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        if (session('role') === 'admin') {
            // Admin hanya bisa lihat semua transaksi
            $transaksis = Transaksi::with('tim')->get();
        } else {
            $tims = Tim::where('user_ulp_id', session('ulp_id'))->pluck('id');

            // Ambil semua transaksi dari tim-tim tersebut
            $transaksis = Transaksi::with('tim')
                ->whereIn('tim_id', $tims)
                ->get();
        }

        return view('transaksis.index', compact('transaksis'));
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
}
