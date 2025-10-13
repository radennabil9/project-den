<?php

namespace App\Http\Controllers;

use App\Models\Tim;
use App\Models\UserULP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class TimController extends Controller
{
    public function index()
    {
        $tims = Tim::all(); 
        return view('tims.index', compact('tims'));
    }

    public function create()
    {
        
        $userUlps = UserULP::all(); // Ambil semua data User ULP
        return view('tims.create', compact('userUlps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_regu' => 'required|string|max:255',
            'anggota' => 'required|string',
            'user_ulp_id' => 'required|exists:user_u_l_p_s,id', // Pastikan user_ulp_id valid
         ]);

        Tim::create($request->all());

        return redirect()->route('tims.index')->with('success', 'Data tim berhasil ditambahkan!');
    }

    public function show(Tim $tim)
    {
        return view('tims.show', compact('tim'));
    }

    public function edit($id)
{
    $tim = Tim::findOrFail($id);
    $userUlps = UserULP::all();
    return view('tims.edit', compact('tim', 'userUlps'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_regu' => 'required',
        'anggota' => 'required',
        'user_ulp_id' => 'required',
    ]);

    $tim = Tim::findOrFail($id);
    $tim->update([
        'nama_regu' => $request->nama_regu,
        'anggota' => $request->anggota,
        'user_ulp_id' => $request->user_ulp_id,
    ]);

    return redirect()->route('tims.index')->with('success', 'Data tim berhasil diperbarui!');
}



    public function destroy(Tim $tim)
    {
        $tim->delete();
        return redirect()->route('tims.index')->with('success', 'Data Tim berhasil dihapus!');
    }

    public function pilihTim()
    {
        $ulpId = session('ulp_id'); // Ambil ID ULP yang login
        $tims = Tim::where('user_ulp_id', $ulpId)->get(); // Ambil tim sesuai ULP

        return view('pilih_tim', compact('tims'));
    }

    public function setTim(Request $request)
    {
        $request->validate([
            'tim_id' => 'required|exists:tims,id'
        ]);

        $tim = Tim::find($request->tim_id);

        session(['tim_id' => $tim->id, 'nama_tim' => $tim->nama_tim]);

        return redirect('/transaksis')->with('success', 'Tim berhasil dipilih: ' . $tim->nama_tim);
    }
}