<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaporanPegawaiRequest extends FormRequest
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
            'pegawai_user_id'       => ['required', 'integer', 'exists:users,id'],
            'nama_file'             => [$this->isMethod('patch') || $this->isMethod('put')
                                        ? 'nullable'
                                        : 'required',
                                         'file', 'mimetypes:application/pdf', 'max:2048']
        ];
    }

    public function messages()
    {
        return [
            'nama_file.required' => 'Silakan unggah file terlebih dahulu.',
            'nama_file.file'     => 'Format tidak valid, data yang dikirim harus berupa file.',
            'nama_file.mimes'    => 'Format file tidak valid. Hanya file PDF yang diperbolehkan.',
            'nama_file.max'      => 'Ukuran file terlalu besar. Maksimal 2 MB.',
        ];
    }
}
