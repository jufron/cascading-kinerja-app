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
                    'user_id_pihak_pertama',
                    'user_id_pihak_kedua',
                    'jenis_kinerja',
                    'head_dokument',
                    'body_dokument',
                    'tahun'
                );
            },
            'dokumentKinerja.userPertama'   => function ($query) {
                $query->select('id', 'nip');
            },
            'dokumentKinerja.userKedua'     => function ($query) {
                $query->select('id', 'nip');
            }
        ])->latest()->get();

        return view('dashboard.catatan.catatan', compact('validationLaporan'));
    }
}
