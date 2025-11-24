<?php

namespace App\Models;

use App\Date\DateFormatCreatedAtAndUpdatedAt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Biodata extends Model
{
    use DateFormatCreatedAtAndUpdatedAt;

    protected $table = 'biodate';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'jabatan_id',
        'bidang',
        'pangkat_golongan',
        'nomor_telepon'
    ];

    public function user () : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jabatan () : BelongsTo
    {
        return $this->belongsTo(Jabatan::class);
    }
}
