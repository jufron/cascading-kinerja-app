<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KinerjaRequest extends FormRequest
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
            'sasaran_strategis'            => ['required', 'string', 'max:10000'], // text
            'sasaran_strategis_individu'   => ['required', 'string', 'max:10000'], // text
            'indikator_kinerja_individu'   => ['required', 'string', 'max:10000'], // text
            'target'                       => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'sasaran_strategis.required'            => 'Sasaran Strategis Kepala Dinas/ Indikator Kinerja Kepala Dinas Yang Diintervensi wajib diisi.',
            'sasaran_strategis.string'              => 'Sasaran Strategis Kepala Dinas/ Indikator Kinerja Kepala Dinas Yang Diintervensi harus berupa teks.',
            'sasaran_strategis.max'                 => 'Sasaran Strategis Kepala Dinas/ Indikator Kinerja Kepala Dinas Yang Diintervensi tidak boleh lebih dari 255 karakter.',

            'sasaran_strategis_individu.required'   => 'Sasaran Strategis Individu / Rencana Hasil Kerja Individu wajib diisi.',
            'sasaran_strategis_individu.string'     => 'Sasaran Strategis Individu / Rencana Hasil Kerja Individu harus berupa teks.',
            'sasaran_strategis_individu.max'        => 'Sasaran Strategis Individu / Rencana Hasil Kerja Individu tidak boleh lebih dari 255 karakter.',

            'indikator_kinerja_individu.required'   => 'Indikator Kinerja Individu wajib diisi.',
            'indikator_kinerja_individu.string'     => 'Indikator Kinerja Individu harus berupa teks.',
            'indikator_kinerja_individu.max'        => 'Indikator Kinerja Individu tidak boleh lebih dari 255 karakter.',

            'target.required'                       => 'Target / Satuan wajib diisi.',
            'target.string'                         => 'Target / Satuan harus berupa teks.',
            'target.max'                            => 'Target / Satuan tidak boleh lebih dari 255 karakter.',
        ];
    }
}
