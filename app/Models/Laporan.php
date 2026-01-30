<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Translation\CreatesPotentiallyTranslatedStrings;

class Laporan extends Model
{
    use CreatesPotentiallyTranslatedStrings;

    protected $table = 'laporan';

    protected $fillable = [

    ];
}
