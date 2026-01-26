<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\DokumentKinerjaRequest;
use App\Models\Biodata;
use App\Models\DokumentKinerja;
use App\Models\Kinerja;
use App\Models\PelaksanaanAnggaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\TemplateProcessor;

class DokumenKinerjaController extends Controller
{
    private function jenisKinerja ()
    {
        return collect([
            'perjanjian kinerja tahun',
            'revisi perjanjian kinerja tahun'
        ]);
    }

    private function generateTahun ()
    {
        return collect(
            range(date('Y'), 2010)
        );
    }

    private function getUser ()
    {
        return User::with([
                'biodata'           => function ($query) {
                    $query->select('user_id', 'nama_lengkap', 'jabatan_id', 'bidang', 'pangkat_golongan');
                },
                'biodata.jabatan'   => function ($query) {
                    $query->select('id', 'nama_jabatan');
                }
        ])->latest()->get();
    }

    public function index () : View
    {
        $dokumentKinerja = DokumentKinerja::with([
            'userPertama' => function ($query) {
                $query->select(['id', 'nip']);
            },
            'userPertama.biodata' => function ($query) {
                $query->select(['id', 'user_id', 'nama_lengkap', 'jabatan_id', 'bidang', 'pangkat_golongan']);
            },
            'userPertama.biodata.jabatan' => function ($query) {
                $query->select(['id', 'nama_jabatan']);
            },
            'userKedua' => function ($query) {
                $query->select(['id', 'nip']);
            },
            'userKedua.biodata' => function ($query) {
                $query->select(['id', 'user_id', 'nama_lengkap', 'jabatan_id', 'bidang', 'pangkat_golongan']);
            },
            'userKedua.biodata.jabatan' => function ($query) {
                $query->select(['id', 'nama_jabatan']);
            },
        ])->latest()->get();

        return view('dashboard.admin.dokumen-kinerja.dokumen-kinerja', compact('dokumentKinerja'));
    }

    public function search(Request $request): JsonResponse
    {
        $search = $request->query('id');

        Log::info('id : ' . $search);

        $biodata = Biodata::with(['jabatan:id,nama_jabatan', 'user:id,nip'])
        ->where('id', $search)
        ->latest()
        ->first();

        if (!$biodata) {
            return response()->json([
                'message'   => 'Barang tidak ditemukan',
                'data'      => null
            ], 404);
        }

        return response()->json([
            'message'   => 'Barang berhasil ditemukan',
            'data'      => [
                'nama_lengkap'  => $biodata->nama_lengkap,
                'nip'           => $biodata->user->nip,
                'pangkat'       => $biodata->pangkat_golongan,
                'bidang'        => $biodata->bidang,
                'jabatan'       => $biodata->jabatan->nama_jabatan
            ]
        ], 200);
    }

    public function create () : View
    {
        $userLogin = auth()->user();
        return view('dashboard.admin.dokumen-kinerja.create', [
            'jenis_kinerja'     => $this->jenisKinerja(),
            'tahun'             => $this->generateTahun(),
            'user'              => $this->getUser(),
            'nama_lengkap'      => $userLogin->biodata->nama_lengkap,
            'nip'               => $userLogin->nip,
            'pangkat'           => $userLogin->biodata->pangkat_golongan,
            'bidang'            => $userLogin->biodata->bidang,
            'jabatan'           => $userLogin->biodata->jabatan->nama_jabatan
        ]);
    }

    public function store (DokumentKinerjaRequest $request) : RedirectResponse
    {
        DokumentKinerja::create([
            'user_id_pihak_pertama'         => auth()->user()->id,
            'user_id_pihak_kedua'           => $request->user_id_pihak_kedua,
            'jenis_kinerja'                 => $request->jenis_kinerja,
            'head_dokument'                 => $request->head_dokumen ?? 'Dalam rangka mewujudkan manajemen pemerintahan yang efektif, transparan, dan akuntabel serta berorientasi pada hasil, kami yang bertandatangan di bawah ini:',
            'body_dokument'                 => $request->body_dokumen ?? 'Pihak pertama berjanji akan mewujudkan target kinerja yang seharusnya sesuai lampiran perjanjian ini, dalam rangka mencapai target kinerja jangka menengah seperti yang telah ditetapkan dalam dokumen perencanaan. Keberhasilan dan kegagalan pencapaian target kinerja tersebut menjadi tanggung jawab kami. Pihak kedua akan melakukan pengawasan dan evaluasi terhadap capaian kinerja dari perjanjian ini dan mengambil tindakan yang diperlukan dalam rangka pemberian penghargaan dan sanksi.',
            'tahun'                         => $request->tahun
        ]);

        alert('Berhasil','Berhasil Mendambahkan Data', 'success');
        return redirect()->route('dokument-kinerja.index');
    }

    public function show (DokumentKinerja $dokumentKinerja) : JsonResponse
    {
        if (! $dokumentKinerja) {
            return response()->json(null, 404);
        }

        $dokumentKinerja->load([
            'userPertama' => function ($query) {
                $query->select(['id', 'nip']);
            },
            'userPertama.biodata' => function ($query) {
                $query->select(['id', 'user_id', 'nama_lengkap', 'jabatan_id', 'bidang', 'pangkat_golongan']);
            },
            'userPertama.biodata.jabatan' => function ($query) {
                $query->select(['id', 'nama_jabatan']);
            },
            'userKedua' => function ($query) {
                $query->select(['id', 'nip']);
            },
            'userKedua.biodata' => function ($query) {
                $query->select(['id', 'user_id', 'nama_lengkap', 'jabatan_id', 'bidang', 'pangkat_golongan']);
            },
            'userKedua.biodata.jabatan' => function ($query) {
                $query->select(['id', 'nama_jabatan']);
            },
            'kinerja' => function ($query) {
                $query->select(['dokument_kinerja_id', 'sasaran_strategis', 'sasaran_strategis_individu', 'indikator_kinerja_individu', 'target']);
            },
        ])->latest()->get();

        return response()->json([
            'tipe_dokument_kinerja'         => $dokumentKinerja->jenis_kinerja,
            'head_dokument'                 => $dokumentKinerja->head_dokument,
            'body_dokument'                 => $dokumentKinerja->body_dokument,
            'tahun'                         => $dokumentKinerja->tahun,

            'nama_user_pertama'             => $dokumentKinerja->userPertama->biodata->nama_lengkap,
            'jabatan_user_pertama'          => $dokumentKinerja->userPertama->biodata->jabatan->nama_jabatan,
            'bidang_user_pertama'           => $dokumentKinerja->userPertama->biodata->bidang,
            'pangkat_golongan_user_pertama' => $dokumentKinerja->userPertama->biodata->pangkat_golongan,
            'nip_user_pertama'              => $dokumentKinerja->userPertama->nip,

            'nama_user_kedua'               => $dokumentKinerja->userKedua->biodata->nama_lengkap,
            'jabatan_user_kedua'            => $dokumentKinerja->userKedua->biodata->jabatan->nama_jabatan,
            'bidang_user_kedua'             => $dokumentKinerja->userKedua->biodata->bidang,
            'pangkat_golongan_user_kedua'   => $dokumentKinerja->userKedua->biodata->pangkat_golongan,
            'nip_user_kedua'                => $dokumentKinerja->userKedua->nip,
            'kinerja'                       => $dokumentKinerja->kinerja()->latest()->get(),
            'pelaksanaan_anggaran'          => PelaksanaanAnggaran::query()->whereIn('kinerja_id', $dokumentKinerja->kinerja()->pluck('id'))->latest()->get(),
            'created_at'                    => $dokumentKinerja->created_at,
            'updated_at'                    => $dokumentKinerja->updated_at,
        ], 200);
    }

    public function edit (DokumentKinerja $dokumentKinerja) : View
    {
        $dokumentKinerja->load([
            'userPertama' => function ($query) {
                $query->select(['id', 'nip']);
            },
            'userPertama.biodata' => function ($query) {
                $query->select(['id', 'user_id', 'nama_lengkap', 'jabatan_id', 'bidang', 'pangkat_golongan']);
            },
            'userPertama.biodata.jabatan' => function ($query) {
                $query->select(['id', 'nama_jabatan']);
            },
            'userKedua' => function ($query) {
                $query->select(['id', 'nip']);
            },
            'userKedua.biodata' => function ($query) {
                $query->select(['id', 'user_id', 'nama_lengkap', 'jabatan_id', 'bidang', 'pangkat_golongan']);
            },
            'userKedua.biodata.jabatan' => function ($query) {
                $query->select(['id', 'nama_jabatan']);
            },
        ])->latest()->get();

        return view('dashboard.admin.dokumen-kinerja.edit', [
            'user'              => $this->getUser(),
            'jenis_kinerja'     => $this->jenisKinerja(),
            'tahun'             => $this->generateTahun(),
            'dokumentKinerja'   => $dokumentKinerja,
        ]);
    }

    public function update (DokumentKinerjaRequest $request, DokumentKinerja $dokumentKinerja) : RedirectResponse
    {
        $dokumentKinerja->update([
            'user_id_pihak_kedua'           => $request->user_id_pihak_kedua,
            'jenis_kinerja'                 => $request->jenis_kinerja,
            'head_dokument'                 => $request->head_dokumen ?? 'Dalam rangka mewujudkan manajemen pemerintahan yang efektif, transparan, dan akuntabel serta berorientasi pada hasil, kami yang bertandatangan di bawah ini:',
            'body_dokument'                 => $request->body_dokumen ?? 'Pihak pertama berjanji akan mewujudkan target kinerja yang seharusnya sesuai lampiran perjanjian ini, dalam rangka mencapai target kinerja jangka menengah seperti yang telah ditetapkan dalam dokumen perencanaan. Keberhasilan dan kegagalan pencapaian target kinerja tersebut menjadi tanggung jawab kami. Pihak kedua akan melakukan pengawasan dan evaluasi terhadap capaian kinerja dari perjanjian ini dan mengambil tindakan yang diperlukan dalam rangka pemberian penghargaan dan sanksi.',
            'tahun'                         => $request->tahun
        ]);
        alert('Berhasil','Berhasil Memperbaharui Data', 'success');
        return redirect()->route('dokument-kinerja.index');
    }

    public function destroy (DokumentKinerja $dokumentKinerja) : RedirectResponse
    {
        $dokumentKinerja->delete();
        alert('Berhasil','Berhasil Menghapus Data', 'success');
        return redirect()->route('dokument-kinerja.index');
    }

    public function exportWord (DokumentKinerja $dokumentKinerja)
    {
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
