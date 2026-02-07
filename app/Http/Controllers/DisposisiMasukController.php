<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectRespone;

class DisposisiMasukController extends Controller
{
    //

    public function index()
    {
        $disposisi = Disposisi::all();
        return view('disposisi.index', compact('disposisi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'surat_masuk_id'    => 'required',
            'dari_user_id'      => 'required',
            'ke_user_id'        => 'required',
            'isi_disposisi'     => 'required|min:2',
            'batas_waktu'       => '',

        ]);

        Disposisi::create([
            'surat_masuk_id'   => $request->surat_masuk_id,
            'dari_user_id'     => $request->dari_user_id,
            'ke_user_id'       => $request->ke_user_id,
            'isi_disposisi'    => $request->isi_disposisi,
            'batas_waktu'      => $request->batas_waktu,
        ]);
         return redirect()->route('suratmasuk')->with(['success' => 'Surat masuk tersimpan']);
    }
}
