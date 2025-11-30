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
use Illuminate\Http\RedirectResponse;

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

    public function kinerja (DokumentKinerja $dokumentKinerja) : View
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

        $kinerja = Kinerja::with(['dokumentKinerja:id'])->latest()->get();
        return view('dashboard.admin.kinerja.kinerja', [
            'dokumentKinerja'       => $dokumentKinerja,
            'kinerja'               => $kinerja
        ]);
    }

    public function show (DokumentKinerja $dokumentKinerja)
    {

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
}
