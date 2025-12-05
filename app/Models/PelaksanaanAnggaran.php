<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PelaksanaanAnggaran extends Model
{
    protected $table = 'pelaksanaan_anggaran';

    protected $fillable = [
        'kinerja_id',
        'program_kegiatan',
        'jumlah_anggaran',
        'target_kegiatan'
    ];

    public function kinerja () : BelongsTo
    {
        return $this->belongsTo(Kinerja::class);
    }
}
