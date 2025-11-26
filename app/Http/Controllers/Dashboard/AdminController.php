<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Jabatan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DaftarAdminRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminController extends Controller
{
    public function index () : View
    {
        return view('dashboard.admin.daftar-admin.daftar-admin', [
            'user'  => User::with([
                'biodata'           => function ($query) {
                    $query->select('user_id', 'jabatan_id', 'nomor_telepon');
                },
                'biodata.jabatan'   => function ($query) {
                    $query->select('id', 'nama_jabatan');
                }
            ])->role('admin')->latest()->get()
        ]);
    }

    public function create () : View
    {
        return view('dashboard.admin.daftar-admin.create', [
            'jabatan'       => Jabatan::query()->latest()->get()
        ]);
    }

    public function store (DaftarAdminRequest $request) : RedirectResponse
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

        $user->assignRole('admin');

        alert('Berhasil','Berhasil Mendambahkan Data', 'success');
        return redirect()->route('daftar-admin.index');
    }

    public function show (User $user) : JsonResponse
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
            'created_at'            => $user->created_at,
            'updated_at'            => $user->updated_at,
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

    public function edit (User $user)
    {
        $user->load([
            'biodata',
            'biodata.jabatan'
        ]);

        // return view()
    }

    public function update (DaftarAdminRequest $request, User $user)
    {
        $user->load([
            'biodata',
            'biodata.jabatan'
        ]);

    }

    public function destroy (User $user) : RedirectResponse
    {
        $user->load([
            'biodata',
            'biodata.jabatan'
        ]);

        if ($user->name === auth()->user()->name) {
            alert()->error('Gagal','Tidak bisa menghapus akun yang sedang aktif');
        } else {
            $user->removeRole('admin');
            $user->biodata()->delete();
            $user->delete();
            alert('Berhasil','Berhasil Menghapus Data', 'success');
        }
        return redirect()->route('daftar-admin.index');
    }
}
