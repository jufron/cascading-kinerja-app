<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $jabatan = Jabatan::query()->latest()->get();
        return view('auth.register', compact('jabatan'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nip'                   => ['required', 'numeric', 'max_digits:20', 'unique:'. User::class],
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'              => ['required', 'confirmed', Rules\Password::defaults()],

            'nama_lengkap'          => ['required', 'string', 'max:255'],
            'jabatan_id'            => ['required', 'integer', 'exists:jabatan,id'],
            'bidang'                => ['required', 'string', 'max:255'],
            'pangkat_golongan'      => ['required', 'string', 'max:255'],
            'nomor_telepon'         => ['required', 'string', 'max:20'],
        ]);

        $user = User::create([
            'nip'       => $request->nip,
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        Biodata::create([
            'user_id'           => $user->id,
            'nama_lengkap'      => $request->nama_lengkap,
            'jabatan_id'        => $request->jabatan_id,
            'bidang'            => $request->bidang,
            'pangkat_golongan'  => $request->pangkat_golongan,
            'nomor_telepon'     => $request->nomor_telepon
        ]);

        event(new Registered($user));

        // Auth::login($user);
        $user->assignRole('pegawai');

        return redirect(route('login', absolute: false));
    }
}
