<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectRespone;
use Illuminate\Support\Facades\DB;

class DisposisiMasukController extends Controller
{
    //

    public function index()
    {
        // $disposisi = Disposisi::all();

        $disposisi = Disposisi::with([
            'suratMasuk',
            'dari',
            'ke'
        ])->latest()->get();
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

        DB::transaction(function () use ($request) {

        Disposisi::create([
            'surat_masuk_id'   => $request->surat_masuk_id,
            'dari_user_id'     => $request->dari_user_id,
            'ke_user_id'       => $request->ke_user_id,
            'isi_disposisi'    => $request->isi_disposisi,
            'batas_waktu'      => $request->batas_waktu,
        ]);

         SuratMasuk::where('id', $request->surat_masuk_id)
                ->update([
                    'stauts' => 'disposisi'
                ]);
            });
         return redirect()->route('suratmasuk')->with(['success' => 'Surat masuk tersimpan']);
    }
}
