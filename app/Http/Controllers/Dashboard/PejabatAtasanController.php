<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PejabatAtasanRequest;
use App\Models\Jabatan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;

class PejabatAtasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('dashboard.admin.pejabat-atasan.daftar-pejabat-atasan', [
            'user'  => User::with([
                'biodata'           => function ($query) {
                    $query->select('user_id', 'jabatan_id', 'nomor_telepon');
                },
                'biodata.jabatan'   => function ($query) {
                    $query->select('id', 'nama_jabatan');
                }
            ])->role('pimpinan')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('dashboard.admin.pejabat-atasan.create', [
            'jabatan'       => Jabatan::query()->latest()->get()
        ]);
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

        $user->biodata()->create([
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
        $user->load([
            'biodata',
            'biodata.jabatan'
        ]);

        if (!$user) {
            return response()->json(null, 404);
        }

        return response()->json([
            'username'              => $user->name,
            'nip'                   => $user->nip,
            'email'                 => $user->email,
            // biodata
            'nama_lengkap'          => $user->biodata->nama_lengkap ?? '-',
            'nama_jabatan'          => $user->biodata->jabatan->nama_jabatan ?? '-',
            'bidang'                => $user->biodata->bidang ?? '-',
            'pangkat_golongan'      => $user->biodata->pangkat_golongan ?? '-',
            'nomor_telepon'         => $user->biodata->nomor_telepon ?? '-',
            'created_at'            => $user->created_at,
            'updated_at'            => $user->updated_at
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->load([
            'biodata',
            'biodata.jabatan'
        ]);
        return view('dashboard.admin.pejabat-atasan.create', [
            'user'  => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PejabatAtasanRequest $request, User $user)
    {
        $user->load([
            'biodata',
            'biodata.jabatan'
        ]);

        $user->update([
            'name'      => $request->name,
            'nip'       => $request->nip,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);

        $user->biodata()->update([
            'nama_lengkap'          => $request->nama_lengkap,
            'jabatan_id'            => $request->jabatan_id,
            'bidang'                => $request->bidang,
            'pangkat_golongan'      => $request->pangkat_golongan,
            'nomor_telepon'         => $request->nomor_telepon
        ]);

        alert('Berhasil','Berhasil Memperbaharui Data', 'success');
        return redirect()->route('pejabat-atasan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->load([
            'biodata',
            'biodata.jabatan'
        ]);

        if ($user->name === auth()->user()->name) {
            alert()->error('Gagal','Tidak bisa menghapus akun yang sedang aktif');
        } else {
            $user->removeRole('pimpinan');
            $user->biodata()->delete();
            $user->delete();
            alert('Berhasil','Berhasil Menghapus Data', 'success');
        }
        return redirect()->route('pejabat-atasan.index');
    }
}
