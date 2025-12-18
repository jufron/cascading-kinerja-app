<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index () : View
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $daftar_admin = 1;
            $daftar_pejabat_atasan = 15;
            $dokumen_kinerja = 1;
            $catatan = 14;
            $validasi_laporan = 1;
            return view('dashboard.admin.dashboard', compact('daftar_admin', 'daftar_pejabat_atasan', 'dokumen_kinerja', 'catatan', 'validasi_laporan'));
        } else if ($user->hasRole('pimpinan')) {
            $dokumen_kinerja = 12;
            $laporan_pegawai = 12;
            $catatan = 11;
            return view('dashboard.pimpinan.dashboard', compact('dokumen_kinerja', 'laporan_pegawai', 'catatan'));
        } else if ($user->hasRole('pegawai')) {
            $dokumen_kinerja = 10;
            $catatan = 10;
            return view('dashboard.pegawai.dashboard', compact('dokumen_kinerja', 'catatan'));
        } else {
            return abort(404);
        }
    }
}
