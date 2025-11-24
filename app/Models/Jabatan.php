<?php

namespace App\Models;

use App\Date\DateFormatCreatedAtAndUpdatedAt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jabatan extends Model
{
    use DateFormatCreatedAtAndUpdatedAt;

    protected $table = 'jabatan';

    protected $fillable = ['nama_jabatan'];

    public function biodate () : HasMany
    {
        return $this->hasMany(Biodata::class);
    }
}
