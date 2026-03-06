<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Tim;

class DashboardController extends Controller
{
    public function index()
    {
        $role = session('role');

        if ($role === 'admin') {
            $tims = Tim::all();
            $transaksis = Transaksi::with('tim')->latest('tanggal')->get();

            return view('dashboard.admin', compact('transaksis', 'tims'));
        }

        if ($role === 'ulp') {
            $tims = Tim::all();
            $transaksis = Transaksi::with('tim')->latest('tanggal')->get();

            return view('dashboard.ulp', compact('transaksis', 'tims'));
        }

        return redirect('/login')->with('error', 'Role tidak dikenali.');
    }
}
