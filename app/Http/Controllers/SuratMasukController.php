<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;

class SuratMasukController extends Controller
{
    public function index()
    {
        $datasurat = SuratMasuk::all();
        return view('dashboard.suratmasuk', compact('datasurat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat'   => 'required|min:3',
            'tanggal_surat' => 'required|date',
            'pengirim'      => 'required',
            'perihal'       => 'required',
            'tujuan'        => 'required',
            'file_surat'    => 'required|file|mimes:jpg,png,pdf,jpeg|max:2048' // Diubah ke 10MB agar lebih aman
        ]);

        // Simpan file
        $path = $request->file('file_surat')->store('surat_masuk', 'public');

        // Simpan ke Database
        SuratMasuk::create([
            'nomor_surat'   => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'pengirim'      => $request->pengirim,
            'perihal'       => $request->perihal,
            'tujuan'        => $request->tujuan,
            'file_surat'    => $path,
        ]);

        return redirect()->back()->with('success','Surat masuk tersimpan');
    }
} // Pastikan kurung ini ada
