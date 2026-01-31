<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\validationLaaporan;
use App\Models\PelaksanaanAnggaran;
use App\Http\Controllers\Controller;
use PhpOffice\PhpWord\TemplateProcessor;

class LaporanController extends Controller
{
    public function index ()
    {
        $laporan = validationLaaporan::with([
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
        ])
            ->where('status', 'disetujui')
            ->latest()
            ->get();

        return view('dashboard.admin.laporan.laporan', compact('laporan'));
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
// DokumentKinerja $dokumentKinerja
    public function download (validationLaaporan $validationLaporan)
    {
        $dokumentKinerja = $validationLaporan->dokumentKinerja;

        // ? query data dulu
        $doctKinerja = $dokumentKinerja->kinerja()->latest()->get();

        $pelaksanaanAnggaran = PelaksanaanAnggaran::query()
                ->whereIn('kinerja_id', $doctKinerja->pluck('id'))
                ->latest()
                ->get();

        $template = new TemplateProcessor(
            storage_path('app/templates/laporan.docx')
        );

        // ? kop surat
        $template->setValue('jenis_kinerja', Str::upper($dokumentKinerja->jenis_kinerja));
        $template->setValue('tahun', now()->year);
        // ? head surat
        $template->setValue('header_dokumen', $dokumentKinerja->head_dokument);

        // ? body
        $template->setValue('nama_pihak_pertama', $dokumentKinerja->userPertama->biodata->nama_lengkap);
        $template->setValue('jabatan_pihak_pertama', $dokumentKinerja->userPertama->biodata->jabatan->nama_jabatan);
        $template->setValue('nip_pihak_pertama', $dokumentKinerja->userPertama->nip);
        $template->setValue('bidang_pihak_pertama', $dokumentKinerja->userPertama->biodata->bidang);
        $template->setValue('pangkat_golongan_pihak_pertama', $dokumentKinerja->userPertama->biodata->pangkat_golongan);

        $template->setValue('nama_pihak_kedua', $dokumentKinerja->userKedua->biodata->nama_lengkap);
        $template->setValue('jabatan_pihak_kedua', $dokumentKinerja->userKedua->biodata->jabatan->nama_jabatan);
        $template->setValue('nip_pihak_kedua', $dokumentKinerja->userKedua->nip);
        $template->setValue('bidang_pihak_kedua', $dokumentKinerja->userKedua->biodata->bidang);
        $template->setValue('pangkat_golongan_pihak_kedua', $dokumentKinerja->userKedua->biodata->pangkat_golongan);

        $template->setValue('body_dokumen', $dokumentKinerja->body_dokument);

        // ? footer
        // todo ambil waktu saat dokumen di generate saja
        // todo contoh format tanggan 21 januari 2025
        $template->setValue('tanggal', now()->isoFormat('D MMMM Y'));

        // ? table kinerja
        $template->cloneRow('no', $doctKinerja->count());
        foreach ($doctKinerja as $index => $item) {
            $template->setValue("no#" . ($index+1), $index+1);
            $template->setValue("sasaran_strategis#" . ($index+1), $item->sasaran_strategis);
            $template->setValue("sasaran_strategis_individu#" . ($index+1), $item->sasaran_strategis_individu);
            $template->setValue("indikator_kinerja_individu#" . ($index+1), $item->indikator_kinerja_individu);
            $template->setValue("target#" . ($index+1), $item->target);
        }

        // ? table anggaran
        $template->cloneRow('no', $pelaksanaanAnggaran->count());
        foreach ($pelaksanaanAnggaran as $index => $item) {
            $template->setValue("no#" . ($index+1), $index+1);
            $template->setValue("program_kegiatan#" . ($index+1), $item->program_kegiatan);
            $template->setValue("jumlah_anggaran#" . ($index+1), $item->jumlah_anggaran);
            $template->setValue("target_kegiatan#" . ($index+1), $item->target_kegiatan);
        }

        $fileName = 'laporan.docx';
        $filePath = storage_path('app/' . $fileName);
        $template->saveAs($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
