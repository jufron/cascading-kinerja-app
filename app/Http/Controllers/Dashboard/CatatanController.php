<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\validationLaaporan;
use App\Http\Controllers\Controller;

class CatatanController extends Controller
{
    public function index ()
    {
        $validationLaporan = validationLaaporan::with([
            'dokumentKinerja'   => function ($query) {
                $query->select(
                    'id',
                    'dokument_kinerja_id',
                    'status',
                    'komentar'
                );
            },
        ])->latest()->get();

        return view('dashboard.catatan.catatan', compact('validationLaporan'));
    }
}
