<?php

namespace App\Models;

use App\Date\DateFormatCreatedAtAndUpdatedAt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;

class PelaksanaanAnggaran extends Model
{
    use HasFactory, DateFormatCreatedAtAndUpdatedAt;

    protected $table = 'pelaksanaan_anggaran';

    protected $fillable = [
        'kinerja_id',
        'program_kegiatan',
        'jumlah_anggaran',
        'target_kegiatan'
    ];

    protected function jumlahAnggaranFormat (): Attribute
    {
        return Attribute::make(
            get: fn () => 'RP ' . number_format($this->jumlah_anggaran, 0, ',', '.')
        );
    }

    public function kinerja () : BelongsTo
    {
        return $this->belongsTo(Kinerja::class);
    }
}
