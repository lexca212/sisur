<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use Illuminate\Http\Request;

class DisposisiMasukController extends Controller
{
    //

    public function index()
    {
        $disposisi = Disposisi::all();
        return view('disposisi.index', compact('disposisi'));
    }
}
