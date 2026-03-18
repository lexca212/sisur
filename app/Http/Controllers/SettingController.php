<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first(); 
        return view('settings.index', compact('setting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|string|unique:settings,chat_id,' . ($request->id ?? 'NULL'),
        ]);

        Setting::updateOrCreate(
            ['id' => $request->id],
            ['chat_id' => $request->chat_id]
        );

        return redirect()->back()->with('success', 'Setting berhasil diperbarui!');
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
        return redirect()->back()->with('success', 'Setting berhasil dihapus!');
    }
}