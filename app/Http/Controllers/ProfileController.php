<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Auth::user(); 
        return view('profile.index', compact('profile'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'chat_id' => 'required|string|unique:users,chat_id,' . $user->id,
        ]);

        User::updateOrCreate(
            ['id' => $user->id],
            ['chat_id' => $request->chat_id]
        );

        return redirect()->back()->with('success', 'Chat ID berhasil disimpan!');
    }

    public function destroy()
    {
        $user = Auth::user();

        $user->update([
            'chat_id' => null
        ]);

        return redirect()->back()->with('success', 'Chat ID berhasil dihapus!');
    }
}
