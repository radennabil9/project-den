<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\UserULP;
use App\Models\Admin;
use App\Models\Tim;
use App\Models\Transaksi;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // 🔹 Cek login admin
        $admin = Admin::where('username', $request->username)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            session([
                'role' => 'admin',
                'nama' => $admin->nama,
                'username' => $admin->username
            ]);
            return redirect()->route('dashboard.admin');
        }

        // 🔹 Cek login user ULP
        $ulp = UserULP::where('username', $request->username)->first();
        if ($ulp && Hash::check($request->password, $ulp->password)) {
            session([
                'role' => 'ulp',
                'nama' => $ulp->nama_ulp,
                'ulp_id' => $ulp->id, // simpan id ULP, bukan tim
                'username' => $ulp->username
            ]);
            return redirect()->route('dashboard.ulp'); // route baru nanti
        }

        return back()->with('error', 'Username atau password salah.');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
