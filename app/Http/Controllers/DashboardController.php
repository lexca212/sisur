<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\Disposisi;
use App\Models\User;
use Carbon\Carbon;
use DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // ======================
        // KPI SURAT
        // ======================
        $totalSurat = SuratMasuk::count();

        $suratBaru = SuratMasuk::where('stauts', 'baru')->count();
        $suratDiproses = SuratMasuk::whereIn('stauts', ['disposisi','diproses'])->count();
        $suratSelesai = SuratMasuk::where('stauts', 'selesai')->count();

        // ======================
        // KPI DISPOSISI
        // ======================
        $pending = Disposisi::where('status', 'menunggu')->count();
        $process = Disposisi::where('status', 'diproses')->count();
        $done = Disposisi::where('status', 'selesai')->count();

        // ======================
        // OVERDUE
        // ======================
        $overdue = Disposisi::where('status', '!=', 'selesai')
            ->whereNotNull('batas_waktu')
            ->whereDate('batas_waktu', '<', now())
            ->count();

        // ======================
        // TREND (PER BULAN)
        // ======================
        $trend = SuratMasuk::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        // ======================
        // TOP USER (BEBAN KERJA)
        // ======================
        $userStats = User::withCount([
            'ke as total_disposisi'
        ])->orderByDesc('total_disposisi')->limit(5)->get();

        // ======================
        // LIST OVERDUE
        // ======================
        $overdueList = Disposisi::with(['suratMasuk','ke'])
            ->where('status', '!=', 'selesai')
            ->whereDate('batas_waktu', '<', now())
            ->limit(10)
            ->get();

        return view('dashboard.index', compact(
            'totalSurat',
            'suratBaru',
            'suratDiproses',
            'suratSelesai',
            'pending',
            'process',
            'done',
            'overdue',
            'trend',
            'userStats',
            'overdueList'
        ));
    }
}
