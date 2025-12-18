<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidasiLaporanRequest;
use App\Models\DokumentKinerja;
use App\Models\validationLaaporan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ValidationLaporanController extends Controller
{
    public function index () : View
    {
        $validationLaporan = validationLaaporan::with([
            'dokumentKinerja'   => function ($query) {
                $query->select(
                    'id',
                    'user_id_pihak_pertama',
                    'user_id_pihak_kedua',
                    'jenis_kinerja',
                    'head_dokument',
                    'body_dokument',
                    'tahun'
                );
            },
        ])->latest()->get();
        return view('dashboard.pimpinan.validasi-laporan.validasi-laporan', compact('validationLaporan'));
    }

    public function create () : View
    {
        $dokumen_kinerja = DokumentKinerja::query()->latest()->get();
        $status = collect([
            'menunggu persetujuan',
             'dibaca',
             'diproses',
             'disetujui',
             'tidak disetujui'
        ]);
        $validasi_laporan = validationLaaporan::whereNull('dokument_kinerja_id')->latest()->get();
        return view('dashboard.pimpinan.validasi-laporan.create', compact('validasi_laporan', 'status', 'dokumen_kinerja'));
    }

    public function store (ValidasiLaporanRequest $request) : RedirectResponse
    {
        validationLaaporan::create([
            'dokument_kinerja_id'       => $request->dokument_kinerja_id,
            'status'                    => $request->status,
            'komentar'                  => $request->komentar
        ]);

        alert('Berhasil','Berhasil Mendambahkan Data', 'success');
        return redirect()->route('validasi-laporan.index');
    }

    public function show (validationLaaporan $validationLaporan)
    {
        if (!$validationLaporan) {
            return response()->json(null, 404);
        }

        return response()->json([
            'status'         => $validationLaporan->status,
            'komentar'       => $validationLaporan->komentar,
            'created_at'     => $validationLaporan->created_at,
            'updated_at'     => $validationLaporan->updated_at,
        ], 200);
    }

    public function edit (validationLaaporan $validationLaporan) : View
    {
        $status = collect([
            'menunggu persetujuan',
             'dibaca',
             'diproses',
             'disetujui',
             'tidak disetujui'
        ]);
        return view('dashboard.pimpinan.validasi-laporan.edit', compact('validationLaporan', 'status'));
    }

    public function update (ValidasiLaporanRequest $request, validationLaaporan $validationLaporan) : RedirectResponse
    {
        $validationLaporan->update([
            'status'                    => $request->status,
            'komentar'                  => $request->komentar
        ]);
        alert('Berhasil','Berhasil Mendambahkan Data', 'success');
        return redirect()->route('validasi-laporan.index');
    }

    public function destroy (validationLaaporan $validationLaporan) : RedirectResponse
    {
        $validationLaporan->delete();
        alert('Berhasil','Berhasil Mendambahkan Data', 'success');
        return redirect()->route('validasi-laporan.index');
    }
}
