<?php

namespace App\Models;

use App\Date\DateFormatCreatedAtAndUpdatedAt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kinerja extends Model
{
    use DateFormatCreatedAtAndUpdatedAt;

    protected $table = 'kinerja';

    protected $fillable = [
        'dokument_kinerja_id',
        'sasaran_strategis',
        'sasaran_strategis_individu',
        'indikator_kinerja_individu',
        'target'
    ];

    public function dokumentKinerja () : BelongsTo
    {
        return $this->belongsTo(Kinerja::class);
    }
}
