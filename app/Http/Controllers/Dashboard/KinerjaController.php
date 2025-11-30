<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KinerjaController extends Controller
{
    protected function jenisKinerja () 
    {
        return collect([
            'perjanjian kinerja tahun',
            'revisi perjanjian kinerja tahun'
        ]);
    }

    protected function generateTahun () 
    {
        return collect(
            range(date('Y'), 2010)
        );
    }

    public function index () : View
    {
        return view('dashboard.admin.kinerja.kinerja', [

        ]);
    }

    public function create () : View
    {
        return view('dashboard.admin.kinerja.create', [
            'jenis_kinerja'     => $this->jenisKinerja(),
            'tahun'             => $this->generateTahun()
        ]);
    }

    public function store(Request $request)
    {

    }

    public function show (int $id)
    {

    }

    public function edit (int $id) : View
    {
        return view('dashboard.admin.kinerja.edit');
    }

    public function update(Request $request, int $id)
    {

    }

    public function destroy (int $id)
    {

    }
}
