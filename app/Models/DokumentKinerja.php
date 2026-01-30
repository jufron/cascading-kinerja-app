<?php

namespace App\Models;

use App\Date\DateFormatCreatedAtAndUpdatedAt;
use App\Observers\DokumentKinerjaObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([DokumentKinerjaObserver::class])]
class DokumentKinerja extends Model
{
    use DateFormatCreatedAtAndUpdatedAt;

    protected $table = 'dokument_kinerja';

    protected $fillable = [
        'user_id_pihak_pertama',
        'user_id_pihak_kedua',
        'jenis_kinerja',
        'head_dokument',
        'body_dokument',
        'tahun'
    ];

    public function userPertama () : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_pihak_pertama');
    }

    public function userKedua () : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_pihak_kedua');
    }

    public function kinerja () : HasMany
    {
        return $this->hasMany(Kinerja::class);
    }

    public function validasiLaporan () : HasOne
    {
        return $this->hasOne(validationLaaporan::class);
    }

    public function catatan () : HasMany
    {
        return $this->hasMany(Catatan::class);
    }
}
