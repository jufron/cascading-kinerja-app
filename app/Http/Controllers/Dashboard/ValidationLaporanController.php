<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidasiLaporanRequest;
use App\Models\DokumentKinerja;
use App\Models\validationLaaporan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            'dokumentKinerja.userPertama'   => function ($query) {
                $query->select('id', 'name', 'nip','email');
            },
            'dokumentKinerja.userPertama.biodata'   => function ($query) {
                $query->select('nama_lengkap', 'jabatan_id', 'bidang', 'pangkat_golongan', 'nomor_telepon');
            },
            'dokumentKinerja.userKedua'     => function ($query) {
                $query->select('id', 'name', 'nip','email');
            },
            'dokumentKinerja.userKedua.biodata'   => function ($query) {
                $query->select('nama_lengkap', 'jabatan_id', 'bidang', 'pangkat_golongan', 'nomor_telepon');
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

        $validationLaporan->load([
            'dokumentKinerja'                               => function ($query) {
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
            'dokumentKinerja.userPertama'                   => function ($query) {
                $query->select('id', 'name', 'nip','email');
            },
            'dokumentKinerja.userPertama.biodata'           => function ($query) {
                $query->select('id', 'user_id', 'nama_lengkap', 'jabatan_id', 'bidang', 'pangkat_golongan', 'nomor_telepon');
            },
            'dokumentKinerja.userPertama.biodata.jabatan'   => function ($query) {
                $query->select('id', 'nama_jabatan');
            },
            'dokumentKinerja.userKedua'                     => function ($query) {
                $query->select('id', 'name', 'nip','email');
            },
            'dokumentKinerja.userKedua.biodata'             => function ($query) {
                $query->select('id', 'user_id', 'nama_lengkap', 'jabatan_id', 'bidang', 'pangkat_golongan', 'nomor_telepon');
            },
            'dokumentKinerja.userPertama.biodata.jabatan'   => function ($query) {
                $query->select('id', 'nama_jabatan');
            },
        ]);

        return response()->json([
            'jenis_kinerja'         => $validationLaporan->dokumentKinerja->jenis_kinerja,
            'head_dokument'         => $validationLaporan->dokumentKinerja->head_dokument,
            'body_dokument'         => $validationLaporan->dokumentKinerja->body_dokument,
            'tahun'                 => $validationLaporan->dokumentKinerja->tahun,

            'user_pertama_name'     => $validationLaporan->dokumentKinerja->userPertama->name,
            'user_pertama_nip'      => $validationLaporan->dokumentKinerja->userPertama->nip,
            'user_pertama_email'    => $validationLaporan->dokumentKinerja->userPertama->email,

            'user_pertama_biodata_nama_lengkap'         => $validationLaporan->dokumentKinerja->userPertama->biodata->nama_lengkap,
            'user_pertama_biodata_jabatan'              => $validationLaporan->dokumentKinerja->userPertama->biodata->jabatan->nama_jabatan,
            'user_pertama_biodata_bidang'               => $validationLaporan->dokumentKinerja->userPertama->biodata->bidang,
            'user_pertama_biodata_pangkat_golongan'     => $validationLaporan->dokumentKinerja->userPertama->biodata->golongan,
            'user_pertama_biodata_nomor_telepon'        => $validationLaporan->dokumentKinerja->userPertama->biodata->nomor_telepon,

            'user_kedua_name'     => $validationLaporan->dokumentKinerja->userKedua->name,
            'user_kedua_nip'      => $validationLaporan->dokumentKinerja->userKedua->nip,
            'user_kedua_email'    => $validationLaporan->dokumentKinerja->userKedua->email,

            'user_kedua_biodata_nama_lengkap'         => $validationLaporan->dokumentKinerja->userKedua->biodata->nama_lengkap,
            'user_kedua_biodata_jabatan'              => $validationLaporan->dokumentKinerja->userKedua->biodata->jabatan->nama_jabatan,
            'user_kedua_biodata_bidang'               => $validationLaporan->dokumentKinerja->userKedua->biodata->bidang,
            'user_kedua_biodata_pangkat_golongan'     => $validationLaporan->dokumentKinerja->userKedua->biodata->golongan,
            'user_kedua_biodata_nomor_telepon'        => $validationLaporan->dokumentKinerja->userKedua->biodata->nomor_telepon,

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
