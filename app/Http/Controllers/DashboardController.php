<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil role dari session login
        $role = session('role');

        // Render tampilan dashboard sesuai role
        if ($role === 'admin') {
            return view('dashboard.admin');
        } elseif ($role === 'user_ulp') {
            return view('dashboard.user_ulp');
        } elseif ($role === 'user_up3') {
            return view('dashboard.user_up3');
        }

        // Jika role tidak dikenal
        return redirect('/login')->with('error', 'Role tidak dikenali.');
    }
}
