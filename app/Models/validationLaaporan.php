<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Date\DateFormatCreatedAtAndUpdatedAt;
use App\Observers\validationLaaporanObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy([validationLaaporanObserver::class])]
class validationLaaporan extends Model
{
    Use DateFormatCreatedAtAndUpdatedAt;

    protected $table = 'validasi_laporan';

    protected $fillable = [
        'dokument_kinerja_id',
        'status',
        'komentar'
    ];

    public function dokumentKinerja ()
    {
        return $this->belongsTo(DokumentKinerja::class);
    }

    public function catatan () : HasMany
    {
        return $this->hasMany(Catatan::class);
    }
}
