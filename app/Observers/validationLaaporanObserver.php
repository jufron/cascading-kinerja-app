<?php

namespace App\Observers;

use App\Models\Catatan;
use App\Models\validationLaaporan;

class validationLaaporanObserver
{
    private function createCatatan ($validationLaaporanID, $dokumentKinerjaID, )
    {
        Catatan::create([
            'validation_laporan_id'     => $validationLaaporanID,
            'dokument_kinerja_id'       => $dokumentKinerjaID,
        ]);
    }

    /**
     * Handle the DokumentKinerja "created" event.
     */
    public function created(validationLaaporan $validationLaaporan): void
    {
        // $this->createCatatan(
        //     $validationLaaporan->id,
        //     $validationLaaporan->dokumentKinerja->id
        // );

        Catatan::create([
            'validation_laporan_id'     => $validationLaaporan->id,
            'dokument_kinerja_id'       => $validationLaaporan->dokumentKinerja->id,
            'status'                    => $validationLaaporan->status,
            'komentar'                  => $validationLaaporan->komentar,
        ]);
    }

    /**
     * Handle the DokumentKinerja "updated" event.
     */
    public function updated(validationLaaporan $validationLaaporan): void
    {
        // $this->createCatatan(
        //     $validationLaaporan->idm,
        //     $validationLaaporan->dokumentKinerja->id
        // );

        Catatan::create([
            'validation_laporan_id'     => $validationLaaporan->id,
            'dokument_kinerja_id'       => $validationLaaporan->dokumentKinerja->id,
            'status'                    => $validationLaaporan->status,
            'komentar'                  => $validationLaaporan->komentar,
        ]);
    }

    /**
     * Handle the DokumentKinerja "deleted" event.
     */
    public function deleted(validationLaaporan $validationLaaporan): void
    {
        //
    }

    /**
     * Handle the DokumentKinerja "restored" event.
     */
    public function restored(validationLaaporan $validationLaaporan): void
    {
        //
    }

    /**
     * Handle the DokumentKinerja "force deleted" event.
     */
    public function forceDeleted(validationLaaporan $validationLaaporan): void
    {
        //
    }
}
