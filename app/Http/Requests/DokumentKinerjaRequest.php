<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DokumentKinerjaRequest extends FormRequest
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
            'user_id_pihak_kedua'       => ['required', 'integer', 'exists:users,id'],
            'jenis_kinerja'             => ['required', 'string', 'max:255'],
            'head_dokument'             => ['nullable', 'string'],
            'body_dokument'             => ['nullable', 'string'],
            'tahun'                     => ['required', 'integer', 'digits:4'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id_pihak_pertama.required' => 'Pihak pertama wajib dipilih.',
            'user_id_pihak_pertama.integer'  => 'Pihak pertama harus berupa angka.',
            'user_id_pihak_pertama.exists'   => 'Pihak pertama yang dipilih tidak ditemukan di sistem.',
            'user_id_pihak_kedua.required'   => 'Pihak kedua wajib dipilih.',
            'user_id_pihak_kedua.integer'    => 'Pihak kedua harus berupa angka.',
            'user_id_pihak_kedua.exists'     => 'Pihak kedua yang dipilih tidak ditemukan di sistem.',
            'jenis_kinerja.required'         => 'Jenis kinerja wajib diisi.',
            'jenis_kinerja.string'           => 'Jenis kinerja harus berupa teks.',
            'jenis_kinerja.max'              => 'Jenis kinerja terlalu panjang.',
            'head_dokument.string'           => 'Head dokumen harus berupa teks.',
            'body_dokument.string'           => 'Body dokumen harus berupa teks.',
            'tahun.required'                 => 'Tahun wajib diisi.',
            'tahun.integer'                  => 'Tahun harus berupa angka.',
            'tahun.digits'                   => 'Tahun harus terdiri dari 4 digit.',
        ];
    }
}
