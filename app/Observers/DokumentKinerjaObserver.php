<?php

namespace App\Observers;

use App\Models\DokumentKinerja;
use App\Models\validationLaaporan;

class DokumentKinerjaObserver
{
    /**
     * Handle the DokumentKinerja "created" event.
     */
    public function created(DokumentKinerja $dokumentKinerja): void
    {
        validationLaaporan::create([
            'dokument_kinerja_id'       => $dokumentKinerja->id,
            'status'                    => 'menunggu persetujuan',
            'komentar'                  => null
        ]);
    }

    /**
     * Handle the DokumentKinerja "updated" event.
     */
    public function updated(DokumentKinerja $dokumentKinerja): void
    {
        //
    }

    /**
     * Handle the DokumentKinerja "deleted" event.
     */
    public function deleted(DokumentKinerja $dokumentKinerja): void
    {
        //
    }

    /**
     * Handle the DokumentKinerja "restored" event.
     */
    public function restored(DokumentKinerja $dokumentKinerja): void
    {
        //
    }

    /**
     * Handle the DokumentKinerja "force deleted" event.
     */
    public function forceDeleted(DokumentKinerja $dokumentKinerja): void
    {
        //
    }
}
