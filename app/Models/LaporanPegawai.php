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
        'nama_file'
    ];
}
