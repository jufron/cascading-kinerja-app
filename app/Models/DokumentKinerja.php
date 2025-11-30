<?php

namespace App\Models;

use App\Date\DateFormatCreatedAtAndUpdatedAt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
