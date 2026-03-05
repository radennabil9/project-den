<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $role = session('role');

        // Ambil semua data transaksi dari database
        $transaksis = Transaksi::all();

        // Render tampilan dashboard sesuai role
        if ($role === 'admin') {
            return view('dashboard.admin', compact('transaksis'));
        } elseif ($role === 'ulp') {
            return view('dashboard.ulp', compact('transaksis'));

        // Jika role tidak dikenal
        return redirect('/login')->with('error', 'Role tidak dikenali.');
    }
}
    }

