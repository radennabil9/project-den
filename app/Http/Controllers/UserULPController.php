<?php

namespace App\Http\Controllers;

use App\Models\UserULP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserULPController extends Controller
{
    public function index()
    {
        $userUlps = UserULP::all();
        return view('userulps.index', compact('userUlps'));
    }

    public function create()
    {
        return view('userulps.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'nama_ulp' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:user_u_l_p_s,username',
        'password' => 'required|string|min:6',
    ]);

         \App\Models\UserULP::create([
        'nama_ulp' => $request->nama_ulp,
        'username' => $request->username,
        'password' => \Illuminate\Support\Facades\Hash::make($request->password),
    ]);

        return redirect()->route('userulps.index')->with('success', 'Data ULP berhasil ditambahkan!');
    }

    public function edit(UserULP $userulp)
    {
        return view('userulps.edit', compact('userulp'));
    }

    public function update(Request $request, UserULP $userulp)
    {
        $request->validate([
            'nama_ulp' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:user_u_l_p_s,username,' . $userulp->id,
        ]);

        $data = [
            'nama_ulp' => $request->nama_ulp,
            'username' => $request->username,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $userulp->update($data);

        return redirect()->route('userulps.index')->with('success', 'Data ULP berhasil diperbarui!');
    }

    public function destroy(UserULP $userulp)
    {
        $userulp->delete();
        return redirect()->route('userulps.index')->with('success', 'Data ULP berhasil dihapus!');
    }
}
