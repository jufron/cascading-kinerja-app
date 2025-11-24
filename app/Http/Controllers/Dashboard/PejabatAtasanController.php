<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PejabatAtasanRequest;
use Illuminate\Http\RedirectResponse;

class PejabatAtasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('dashboard.admin.pejabat-atasan.daftar-pejabat-atasan', [
            'user'  => User::query()->role('pimpinan')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('dashboard.admin.pejabat-atasan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PejabatAtasanRequest $request) : RedirectResponse
    {
        $user = User::create([
            'name'      => $request->name,
            'nip'       => $request->nip,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);

        $user->biodata()->crate([
            'nama_lengkap'          => $request->nama_lengkap,
            'jabatan_id'            => $request->jabatan_id,
            'bidang'                => $request->bidang,
            'pangkat_golongan'      => $request->pangkat_golongan,
            'nomor_telepon'         => $request->nomor_telepon
        ]);

        $user->assignRole('pimpinan');

        alert('Berhasil','Berhasil Menambahkan Data', 'success');
        return redirect()->route('pejabat-atasan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.admin.pejabat-atasan.create');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PejabatAtasanRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
