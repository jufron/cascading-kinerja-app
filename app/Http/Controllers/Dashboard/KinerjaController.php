<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Kinerja;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\DokumentKinerja;
use App\Http\Controllers\Controller;
use App\Http\Requests\KinerjaRequest;
use App\Models\PelaksanaanAnggaran;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class KinerjaController extends Controller
{
    public function index (DokumentKinerja $dokumentKinerja) : View
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

        // * kinerja model
        $kinerja = Kinerja::with(['dokumentKinerja:id'])->where('dokument_kinerja_id', $dokumentKinerja->id)->latest()->get();

        // * pelaksanaan anggaran model
        $pelaksanaanAnggaran = PelaksanaanAnggaran::query()->whereIn('kinerja_id', $kinerja->pluck('id'))->latest()->get();

        return view('dashboard.admin.kinerja.kinerja', [
            'dokumentKinerja'       => $dokumentKinerja,
            'kinerja'               => $kinerja,
            'pelaksanaanAnggaran'   => $pelaksanaanAnggaran
        ]);
    }

    public function create (DokumentKinerja $dokumentKinerja) : View
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
        return view('dashboard.admin.kinerja.create', [
            'dokumentKinerja'       => $dokumentKinerja,
            'kinerja'               => $kinerja
        ]);
    }

    public function store(KinerjaRequest $request, DokumentKinerja $dokumentKinerja) : RedirectResponse
    {
        Kinerja::create([
            'dokument_kinerja_id'           => $dokumentKinerja->id,
            'sasaran_strategis'             => $request->sasaran_strategis,
            'sasaran_strategis_individu'    => $request->sasaran_strategis_individu,
            'indikator_kinerja_individu'    => $request->indikator_kinerja_individu,
            'target'                        => $request->target
        ]);

        alert('Berhasil','Berhasil Mendambahkan Data', 'success');
        return redirect()->route('kinerja.index', $dokumentKinerja);
    }

    public function show (DokumentKinerja $dokumentKinerja, Kinerja $kinerja) : JsonResponse
    {
        if (!$kinerja) {
            return response()->json(null, 404);
        }
        return response()->json([
            'dokument_kinerja_id'               => $dokumentKinerja,
            'sasaran_strategis'                 => $kinerja->sasaran_strategis,
            'sasaran_strategis_individu'        => $kinerja->sasaran_strategis_individu,
            'target'                            => $kinerja->target,
            'created_at'                        => $kinerja->created_at,
            'updated_at'                        => $kinerja->updated_at
        ], 200);
    }

    public function edit (DokumentKinerja $dokumentKinerja, Kinerja $kinerja) : View
    {
        return view('dashboard.admin.kinerja.edit', [
            'dokumentKinerja'       => $dokumentKinerja,
            'kinerja'               => $kinerja
        ]);
    }

    public function update(KinerjaRequest $request, DokumentKinerja $dokumentKinerja,  Kinerja $kinerja) : RedirectResponse
    {
        $kinerja->update([
            'dokument_kinerja_id'           => $dokumentKinerja->id,
            'sasaran_strategis'             => $request->sasaran_strategis,
            'sasaran_strategis_individu'    => $request->sasaran_strategis_individu,
            'indikator_kinerja_individu'    => $request->indikator_kinerja_individu,
            'target'                        => $request->target
        ]);

        alert('Berhasil','Berhasil Memperbharui Data', 'success');
        return redirect()->route('kinerja.index', $dokumentKinerja);
    }

    public function destroy (DokumentKinerja $dokumentKinerja,  Kinerja $kinerja) : RedirectResponse
    {
        $kinerja->delete();
        alert('Berhasil','Berhasil Menghapus Data', 'success');
        return redirect()->route('kinerja.index', $dokumentKinerja);
    }
}
