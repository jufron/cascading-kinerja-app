<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DaftarAdminRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminController extends Controller
{
    public function index () : View
    {
        return view('dashboard.admin.daftar-admin.daftar-admin', [
            'user'  => User::query()->role('admin')->latest()->get()
        ]);
    }

    public function create () : View
    {
        return view('dashboard.admin.daftar-admin.create');
    }

    public function store (DaftarAdminRequest $request) : RedirectResponse
    {
        $user = User::create([
            'name'      => $request->name,
            'nip'       => $request->nip,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);

        $user->assignRole('admin');

        alert('Berhasil','Berhasil Mendambahkan Data', 'success');
        return redirect()->route('daftar-admin.index');
    }

    public function show (User $user) : JsonResponse
    {
        if (!$user) {
            return response()->json(null, 404);
        }

        return response()->json([
            'username'       => $user->name,
            'nip'            => $user->nip,
            'email'          => $user->email,
            'created_at'     => $user->created_at,
            'updated_at'     => $user->updated_at
        ], 200);
    }

    public function edit (User $user)
    {
        // return view()
    }

    public function update (DaftarAdminRequest $request, User $user)
    {

    }

    public function destroy (User $user) : RedirectResponse
    {
        if ($user->name === auth()->user()->name) {
            alert()->error('Gagal','Tidak bisa menghapus akun yang sedang aktif');
        } else {
            // $user->delete();
            alert('Berhasil','Berhasil Menghapus Data', 'success');
        }
        return redirect()->route('daftar-admin.index');
    }
}
