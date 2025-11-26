<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class DaftarAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'      => ['required', 'string', 'max:255'],
            'nip'       => ['required', 'numeric', 'max_digits:20', 'unique:'. User::class],
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'  => ['required', 'confirmed', Password::defaults()],
            // biodata
            'nama_lengkap'          => ['required', 'string', 'max:255'],
            'jabatan_id'            => ['required', 'integer', 'exists:jabatan,id'],
            'bidang'                => ['required', 'string', 'max:255'],
            'pangkat_golongan'      => ['required', 'string', 'max:255'],
            'nomor_telepon'         => ['required', 'string', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'         => 'Nama wajib diisi.',
            'name.string'           => 'Nama harus berupa teks.',
            'name.max'              => 'Nama tidak boleh melebihi :max karakter.',
            'NIP.numeric'           => 'NIP harus berupa angka.',
            'NIP.digits'            => 'NIP harus terdiri dari :digits digit.',
            'NIP.unique'            => 'NIP ini sudah terdaftar. Gunakan NIP lain.',
            'email.required'        => 'Alamat email wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
            'email.unique'          => 'Email ini sudah digunakan. Gunakan email lain.',
            'email.max'             => 'Email tidak boleh melebihi :max karakter.',
            'password.required'     => 'Kata sandi wajib diisi.',
            'password.confirmed'    => 'Konfirmasi kata sandi tidak cocok.',
            'password.min'          => 'Kata sandi minimal harus :min karakter.',
            // biodata
            'nama_lengkap.string'       => 'Nama lengkap harus berupa teks.',
            'nama_lengkap.max'          => 'Nama lengkap maksimal 255 karakter.',
            'jabatan_id.integer'        => 'Jabatan tidak valid.',
            'jabatan_id.exists'         => 'Jabatan tidak ditemukan.',
            'bidang.string'             => 'Bidang harus berupa teks.',
            'bidang.max'                => 'Bidang maksimal 255 karakter.',
            'pangkat_golongan.string'   => 'Pangkat golongan harus berupa teks.',
            'pangkat_golongan.max'      => 'Pangkat golongan maksimal 255 karakter.',
            'nomor_telepon.string'      => 'Nomor telepon harus berupa teks.',
            'nomor_telepon.max'         => 'Nomor telepon maksimal 20 karakter.',
        ];
    }
}
