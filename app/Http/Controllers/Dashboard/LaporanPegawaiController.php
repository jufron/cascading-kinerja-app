<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\LaporanPegawai;
use App\Http\Controllers\Controller;
use App\Http\Requests\LaporanPegawaiRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class LaporanPegawaiController extends Controller
{
    public function index () : View
    {
        return view('dashboard.pimpinan.laporan-pegawai.laporan-pegawai', [
            'laporanPegawai'    => LaporanPegawai::with([
                'user'                  => function ($query) {
                    $query->select(['nip', 'name']);
                },
                'user.biodata'          => function ($query) {
                    $query->select(['nama_lengkap']);
                },
                'pegawaiUser'           => function ($query) {
                    $query->select(['nip', 'nama']);
                },
                'pegawaiUser.biodata'   => function ($query) {
                    $query->select(['nama_lengkap']);
                }
            ])->latest()->get()
        ]);
    }

    public function create () : View
    {
        return view('dashboard.pimpinan.laporan-pegawai.create', [
            'user'  => User::with([
                'biodata'           => function ($query) {
                    $query->select('user_id', 'jabatan_id', 'nomor_telepon');
                },
                'biodata.jabatan'   => function ($query) {
                    $query->select('id', 'nama_jabatan');
                }
            ])->role('pegawai')->latest()->get()
        ]);
    }

    public function store (LaporanPegawaiRequest $request) : RedirectResponse
    {
        $nama_file = null;
        if($request->file('file-laporan')) {
            $nama_file = $request->file('file-laporan')->store('laporan-pegawai');
        }
        LaporanPegawai::create([
            'user_id'               => auth()->user()->id,
            'pegawai_user_id'       => $request->user_id,
            'nama_file'             => $nama_file
        ]);

        alert('Berhasil','Berhasil Mendambahkan Data', 'success');
        return redirect()->route('laporan-pegaai.index');
    }

    public function show (LaporanPegawai $laporanPegawai)
    {
        if (!$laporanPegawai) {
            return response()->json(null, 404);
        }
    }

    public function edit (LaporanPegawai $laporanPegawai) : View
    {
        return view('dashboard.admin.daftar-admin.edit', compact('laporanPegawai'));
    }

    public function update (LaporanPegawaiRequest $request, LaporanPegawai $laporanPegawai) : RedirectResponse
    {
        $nama_file = $laporanPegawai->nama_file;

        if($request->file('file-laporan')) {
            if ($nama_file && Storage::disk('public')->exists($nama_file)) {
                Storage::disk('public')->delete($nama_file);
            }

            $nama_file = $request->file('file-laporan')->store('laporan-pegawai');
        }

        $laporanPegawai->update([
            'pegawai_user_id'       => $request->user_id,
            'nama_file'             => $nama_file
        ]);

        alert('Berhasil','Berhasil Memperbaharui Data', 'success');
        return redirect()->route('laporan-pegaai.index');
    }

    public function destroy (LaporanPegawai $laporanPegawai) : RedirectResponse
    {
        $nama_file = $laporanPegawai->nama_file;

        if ($nama_file && Storage::disk('public')->exists($nama_file)) {
            Storage::disk('public')->delete($nama_file);
        }

        alert('Berhasil','Berhasil Memperbaharui Data', 'success');
        return redirect()->route('laporan-pegaai.index');
    }
}
