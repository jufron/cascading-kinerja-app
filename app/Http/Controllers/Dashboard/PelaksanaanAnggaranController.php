<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PelaksanaanAnggaranRequest;
use App\Models\DokumentKinerja;
use App\Models\Kinerja;
use App\Models\PelaksanaanAnggaran;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PelaksanaanAnggaranController extends Controller
{
    public function search(Request $request, DokumentKinerja $dokumentKinerja): JsonResponse
    {
        $search = $request->query('id');

        Log::info('id : '.$search);

        $kinerja = Kinerja::query()
            ->where('id', $search)
            ->latest()
            ->first();

        if (! $kinerja) {
            return response()->json([
                'message' => 'Barang tidak ditemukan',
                'data' => null,
            ], 404);
        }
        // Log::info('data' . json_encode($kinerja, JSON_PRETTY_PRINT));

        return response()->json([
            'message' => 'Data berhasil ditemukan',
            'data' => [
                'sasaran_strategis' => $kinerja->sasaran_strategis,
                'sasaran_strategis_individu' => $kinerja->sasaran_strategis_individu,
                'indikator_kinerja_individu' => $kinerja->indikator_kinerja_individu,
                'target' => $kinerja->target,
            ],
        ], 200);
    }

    public function create(DokumentKinerja $dokumentKinerja): View
    {
        return view('dashboard.admin.pelaksanaan-anggaran.create', [
            'dokumentKinerja' => $dokumentKinerja,
            'kinerja' => $dokumentKinerja->kinerja()->latest()->get(),
        ]);
    }

    public function store(PelaksanaanAnggaranRequest $request, DokumentKinerja $dokumentKinerja): RedirectResponse
    {
        PelaksanaanAnggaran::create([
            'kinerja_id' => $request->kinerja_id,
            'program_kegiatan' => $request->program_kegiatan,
            'jumlah_anggaran' => $request->jumlah_anggaran,
            'target_kegiatan' => $request->target_kegiatan,
        ]);

        alert('Berhasil', 'Berhasil Mendambahkan Data', 'success');

        return redirect()->route('kinerja.index', $dokumentKinerja);
    }

    public function show(DokumentKinerja $dokumentKinerja, PelaksanaanAnggaran $pelaksanaanAnggaran): JsonResponse
    {
        if (! $pelaksanaanAnggaran) {
            return response()->json(null, 404);
        }

        return response()->json([
            'program_kegiatan'              => $pelaksanaanAnggaran->program_kegiatan,
            'jumlah_anggaran'               => $pelaksanaanAnggaran->jumlah_anggaran_format,
            'target_kegiatan'               => $pelaksanaanAnggaran->target_kegiatan,
            'created_at'                    => $pelaksanaanAnggaran->created_at,
            'updated_at'                    => $pelaksanaanAnggaran->updated_at
        ], 200);
    }

    public function edit(DokumentKinerja $dokumentKinerja, PelaksanaanAnggaran $pelaksanaanAnggaran): View
    {
        return view('dashboard.admin.pelaksanaan-anggaran.edit', [
            'pelaksanaanAnggaran'   => $pelaksanaanAnggaran,
            'dokumentKinerja'       => $dokumentKinerja,
            'kinerja'               => $dokumentKinerja->kinerja()->latest()->get()
        ]);
    }

    public function update(PelaksanaanAnggaranRequest $request, DokumentKinerja $dokumentKinerja, PelaksanaanAnggaran $pelaksanaanAnggaran): RedirectResponse
    {
        $pelaksanaanAnggaran->update([
            'kinerja_id'            => $request->kinerja_id,
            'program_kegiatan'      => $request->program_kegiatan,
            'jumlah_anggaran'       => $request->jumlah_anggaran,
            'target_kegiatan'       => $request->target_kegiatan,
        ]);
        alert('Berhasil', 'Berhasil Memperbaharui Data', 'success');
        return redirect()->route('kinerja.index', $dokumentKinerja);
    }

    public function destroy(DokumentKinerja $dokumentKinerja, PelaksanaanAnggaran $pelaksanaanAnggaran): RedirectResponse
    {
        $pelaksanaanAnggaran->delete();
        alert('Berhasil', 'Berhasil Memperbaharui Data', 'success');
        return redirect()->route('kinerja.index', $dokumentKinerja);
    }
}
