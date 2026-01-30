<?php

namespace App\Models;

use App\Date\DateFormatCreatedAtAndUpdatedAt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Catatan extends Model
{
    use DateFormatCreatedAtAndUpdatedAt;

    protected $table = 'catatan';

    protected $fillable = [
        'validation_laporan_id',
        'dokument_kinerja_id',
        'status',
        'komentar'
    ];

    public function validationLaporan () : BelongsTo
    {
        return $this->belongsto(validationLaaporan::class);
    }

    public function dokumentKinerja () : BelongsTo
    {
        return $this->belongsTo(DokumentKinerja::class);
    }

}
