<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Catatan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\validationLaaporan;
use App\Models\PelaksanaanAnggaran;
use App\Http\Controllers\Controller;

class CatatanController extends Controller
{
    public function index ()
    {
        $catatan = Catatan::with([
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
                $query->select('id', 'nip');
            },
            'dokumentKinerja.userKedua'     => function ($query) {
                $query->select('id', 'nip');
            },
            'validationLaporan'             => function ($query) {
                $query->select('id', 'dokument_kinerja_id', 'status', 'komentar');
            }
        ])->latest()->get();

        return view('dashboard.catatan.catatan', compact('catatan'));
    }

    public function show (Catatan $catatan) : JsonResponse
    {
        if (! $catatan) {
            return response()->json(null, 404);
        }

        $catatan->load([
            'dokumentKinerja.userPertama' => function ($query) {
                $query->select(['id', 'nip']);
            },
            'dokumentKinerja.userPertama.biodata' => function ($query) {
                $query->select(['id', 'user_id', 'nama_lengkap', 'jabatan_id', 'bidang', 'pangkat_golongan']);
            },
            'dokumentKinerja.userPertama.biodata.jabatan' => function ($query) {
                $query->select(['id', 'nama_jabatan']);
            },
            'dokumentKinerja.userKedua' => function ($query) {
                $query->select(['id', 'nip']);
            },
            'dokumentKinerja.userKedua.biodata' => function ($query) {
                $query->select(['id', 'user_id', 'nama_lengkap', 'jabatan_id', 'bidang', 'pangkat_golongan']);
            },
            'dokumentKinerja.userKedua.biodata.jabatan' => function ($query) {
                $query->select(['id', 'nama_jabatan']);
            },
            'dokumentKinerja.kinerja' => function ($query) {
                $query->select(['id', 'dokument_kinerja_id', 'sasaran_strategis', 'sasaran_strategis_individu', 'indikator_kinerja_individu', 'target']);
            },
        ])->latest()->get();

        return response()->json([
            'tipe_dokument_kinerja'         => $catatan->dokumentKinerja->jenis_kinerja,
            'head_dokument'                 => $catatan->dokumentKinerja->head_dokument,
            'body_dokument'                 => $catatan->dokumentKinerja->body_dokument,
            'tahun'                         => $catatan->dokumentKinerja->tahun,

            'nama_user_pertama'             => $catatan->dokumentKinerja->userPertama->biodata->nama_lengkap,
            'jabatan_user_pertama'          => $catatan->dokumentKinerja->userPertama->biodata->jabatan->nama_jabatan,
            'bidang_user_pertama'           => $catatan->dokumentKinerja->userPertama->biodata->bidang,
            'pangkat_golongan_user_pertama' => $catatan->dokumentKinerja->userPertama->biodata->pangkat_golongan,
            'nip_user_pertama'              => $catatan->dokumentKinerja->userPertama->nip,

            'nama_user_kedua'               => $catatan->dokumentKinerja->userKedua->biodata->nama_lengkap,
            'jabatan_user_kedua'            => $catatan->dokumentKinerja->userKedua->biodata->jabatan->nama_jabatan,
            'bidang_user_kedua'             => $catatan->dokumentKinerja->userKedua->biodata->bidang,
            'pangkat_golongan_user_kedua'   => $catatan->dokumentKinerja->userKedua->biodata->pangkat_golongan,
            'nip_user_kedua'                => $catatan->dokumentKinerja->userKedua->nip,
            'kinerja'                       => $catatan->dokumentKinerja->kinerja()->latest()->get(),
            'pelaksanaan_anggaran'          => PelaksanaanAnggaran::query()->whereIn('kinerja_id', $catatan->dokumentKinerja->kinerja()->pluck('id'))->latest()->get(),
            'created_at'                    => $catatan->created_at,
            'updated_at'                    => $catatan->updated_at,
        ], 200);
    }
}
