<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PelanggaranRequest extends FormRequest
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
            'jenis' => 'required|in:prestasi,pelanggaran',
            'kategori' => 'required|in:akademik,non-akademik',
            'poin' => 'required|integer',
            'keterangan' => 'nullable|string',
            'sanksi' => 'nullable|string',
            'tanggal' => 'nullable|date',
        ];
    }
}
