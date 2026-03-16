<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    public function index()
    {
        $instansi = Instansi::all();
        return view('instansi.index', compact('instansi'));
    }

    public function create()
    {
        return view('instansi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code'   => 'required|unique:instansi,code',
            'nama'   => 'required',
            'email'  => 'required|email|unique:instansi,email',
            'tlpn'   => 'required|string|min:10|max:15|regex:/^[0-9]+$/',
            'alamat' => 'required',
        ]);

        Instansi::create($request->all());

        return redirect()->route('instansi.index')
                         ->with('success', 'Data instansi berhasil ditambahkan.');
    }

    public function edit(Instansi $instansi)
    {
        return view('instansi.edit', compact('instansi'));
    }

    public function update(Request $request, Instansi $instansi)
    {
        $request->validate([
            'code'   => 'required|unique:instansi,code,' . $instansi->id,
            'nama'   => 'required',
            'email'  => 'required|email|unique:instansi,email,' . $instansi->id,
            'tlpn'   => 'required|string|min:10|max:15|regex:/^[0-9]+$/',
            'alamat' => 'required',
        ]);

        $instansi->update($request->all());

        return redirect()->route('instansi.index')
                         ->with('success', 'Data instansi berhasil diperbarui.');
    }

    public function destroy(Instansi $instansi)
    {
        $instansi->delete();

        return redirect()->route('instansi.index')
                         ->with('success', 'Data instansi berhasil dihapus.');
    }
}