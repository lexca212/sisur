<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    public function index()
    {
        $datasurat = SuratMasuk::all();
        $users = User::orderBy('name')->get();
        return view('dashboard.suratmasuk', compact('datasurat','users'));
    }

    public function store(Request $request): RedirectResponse
    {
        //dd('MASUK STORE');

        $request->validate([
            'nomor_surat'   => 'required|min:3',
            'tangal_surat' => 'required',
            'pengirim'      => 'required',
            'perihal'       => 'required',
            'tujuan'        => 'required',
            'stauts'        => '',
            'file_surat'    => 'required|file|mimes:jpg,png,pdf,jpeg|max:2048' // Diubah ke 10MB agar lebih aman
        ]);

        // Simpan file
        $path = $request->file('file_surat')->store('surat_masuk', 'public');

        // Simpan ke Database
        SuratMasuk::create([
            'nomor_surat'   => $request->nomor_surat,
            'tangal_surat' => $request->tangal_surat,
            'pengirim'      => $request->pengirim,
            'perihal'       => $request->perihal,
            'tujuan'        => $request->tujuan,
            'stauts'        => 'baru',
            'file_surat'    => $path,
        ]);

        return redirect()->route('suratmasuk')->with(['success' => 'Surat masuk tersimpan']);
    }

    public function edit($id)
    {
        $datasurat = SuratMasuk::FindOrFail($id);

        return view('dashboard.editsurat', compact('datasurat'));
    }

    public function update(Request $request, $id)
    {
        $datasurat = SuratMasuk::FindOrFail($id);

        $request->validate([
            'nomor_surat'   => 'required|min:3',
            'tangal_surat'  => 'required',
            'pengirim'      => 'required',
            'perihal'       => 'required',
            'tujuan'        => 'required',
            'stauts'        => '',
            'file_surat'    => 'nullable|file|mimes:jpg,png,pdf,jpeg|max:2048' 
        ]);

        $data = [
            'nomor_surat'   => $request->nomor_surat,
            'tangal_surat'  => $request->tangal_surat,
            'pengirim'      => $request->pengirim,
            'perihal'       => $request->perihal,
            'tujuan'        => $request->tujuan,
        ];

        // dd($request->hasFile('file_surat'));

        if ($request->hasFile('file_surat')) {

            if ($datasurat->file_surat) {
                Storage::disk('public')->delete($datasurat->file_surat);
            }

            $path = $request->file('file_surat')->store('surat_masuk','public');

            $data['file_surat'] = $path;
            $data['stauts'] = 'baru';
        }

        $datasurat->update($data);

        return redirect()->route('suratmasuk')
        ->with('success','Surat berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = SuratMasuk::findOrFail($id);

        $data->delete();

        return redirect()->route('suratmasuk')
        ->with('success','Surat berhasil dihapus');
    }
} // Pastikan kurung ini ada
