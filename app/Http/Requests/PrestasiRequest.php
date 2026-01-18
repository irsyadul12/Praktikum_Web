<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestasiRequest extends FormRequest
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
            'student_id' => 'required|exists:students,id',
            'nama_prestasi' => 'required|string|max:255',
            'tingkat' => 'required|in:Sekolah,Kecamatan,Provinsi,Nasional,Internasional',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ];
    }
}
