<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidasiLaporanRequest;
use App\Models\Catatan;
use App\Models\DokumentKinerja;
use App\Models\User;
use App\Models\validationLaaporan;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index () : View
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $daftar_admin = User::role('admin')->count();
            $daftar_pejabat_atasan = User::role('pimpinan')->count();
            $dokumen_kinerja = DokumentKinerja::query()->get()->count();
            $catatan = Catatan::query()->count();
            $validasi_laporan = validationLaaporan::query()->count();
            $validasi_laporan_disetujui = validationLaaporan::query()->where('status', 'disetujui')->count();
            $validasi_laporan_dibaca = validationLaaporan::query()->where('status', 'dibaca')->count();
            $validasi_laporan_diproses = validationLaaporan::query()->where('status', 'diproses')->count();
            $validasi_laporan_tidak_disetujui = validationLaaporan::query()->where('status', 'tidak disetujui')->count();
            $validation_laporan_menunggu_persetujuan = validationLaaporan::query()->where('status', 'menunggu persetujuan')->count();
            return view('dashboard.admin.dashboard', compact(
                'daftar_admin',
                'daftar_pejabat_atasan',
                'dokumen_kinerja',
                'catatan',
                'validasi_laporan',
                'validasi_laporan_disetujui',
                'validasi_laporan_tidak_disetujui',
                'validasi_laporan_diproses',
                'validasi_laporan_dibaca',
                'validation_laporan_menunggu_persetujuan'
            ));
        } else if ($user->hasRole('pimpinan')) {
            $dokumen_kinerja = DokumentKinerja::query()->get()->count();
            $userPimpinann = User::role('pimpinan')->count();
            $catatan = Catatan::query()->count();
            return view('dashboard.pimpinan.dashboard', compact('dokumen_kinerja', 'userPimpinann', 'catatan'));
        } else if ($user->hasRole('pegawai')) {
            $dokumen_kinerja = DokumentKinerja::query()->get()->count();
            $catatan = Catatan::query()->count();
            return view('dashboard.pegawai.dashboard', compact('dokumen_kinerja', 'catatan'));
        } else {
            return abort(404);
        }
    }
}
