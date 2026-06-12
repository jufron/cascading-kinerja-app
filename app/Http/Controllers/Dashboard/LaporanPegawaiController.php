<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
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
            'laporanPegawai'    => LaporanPegawai::latest()->get()
        ]);
    }

    public function create () : View
    {
        return view('dashboard.pimpinan.laporan-pegawai.create');
    }

    public function store (LaporanPegawaiRequest $request) : RedirectResponse
    {
        $nama_file = null;
        if($request->file('nama_file')) {
            $nama_file = $request->file('nama_file')->store('laporan-pegawai', 'public');
        }
        LaporanPegawai::create([
            'nama_file'             => $nama_file
        ]);

        alert('Berhasil','Berhasil Mendambahkan Data', 'success');
        return redirect()->route('laporan-pegaai.index');
    }

    public function show (LaporanPegawai $laporanPegawai) : JsonResponse
    {
        if (!$laporanPegawai) {
            return response()->json(null, 404);
        }

        return response()->json([
            'nama_file'  => basename($laporanPegawai->nama_file),
            'created_at' => $laporanPegawai->created_at ? $laporanPegawai->created_at->format('Y-m-d H:i:s') : '-',
            'updated_at' => $laporanPegawai->updated_at ? $laporanPegawai->updated_at->format('Y-m-d H:i:s') : '-',
        ], 200);
    }

    public function edit (LaporanPegawai $laporanPegawai) : View
    {
        return view('dashboard.pimpinan.laporan-pegawai.edit', compact('laporanPegawai'));
    }

    public function update (LaporanPegawaiRequest $request, LaporanPegawai $laporanPegawai) : RedirectResponse
    {
        $nama_file = $laporanPegawai->nama_file;

        if($request->file('nama_file')) {
            if ($nama_file && Storage::disk('public')->exists($nama_file)) {
                Storage::disk('public')->delete($nama_file);
            }
            $nama_file = $request->file('nama_file')->store('laporan-pegawai', 'public');
        }

        $laporanPegawai->update([
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
        $laporanPegawai->delete();
        alert('Berhasil','Berhasil Memperbaharui Data', 'success');
        return redirect()->route('laporan-pegaai.index');
    }

    public function download (LaporanPegawai $laporanPegawai)
    {
        $path = storage_path("app/public/{$laporanPegawai->nama_file}");
        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path);
    }
}
