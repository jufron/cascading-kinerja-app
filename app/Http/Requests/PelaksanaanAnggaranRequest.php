<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PelaksanaanAnggaranRequest extends FormRequest
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
            'kinerja_id'            => ['required','integer','exists:kinerja,id'],
            'program_kegiatan'      => ['required','string','max:255'],
            'jumlah_anggaran'       => ['required','numeric','min:0'],
            'target_kegiatan'       => ['required','string','max:255'],
        ];
    }
}
