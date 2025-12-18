<?php

namespace App\Models;

use App\Date\DateFormatCreatedAtAndUpdatedAt;
use Illuminate\Database\Eloquent\Model;

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
}
