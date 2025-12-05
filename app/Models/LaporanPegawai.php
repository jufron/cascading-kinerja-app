<?php

namespace App\Models;

use App\Date\DateFormatCreatedAtAndUpdatedAt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaporanPegawai extends Model
{
    use DateFormatCreatedAtAndUpdatedAt;

    protected $table = 'laporan_pegawai';

    protected $fillable = [
        'user_id',
        'pegawai_user_id',
        'nama_file'
    ];

    public function user () : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pegawaiUser () : BelongsTo
    {
        return $this->belongsTo(User::class, 'pegawai_user_id');
    }
}
