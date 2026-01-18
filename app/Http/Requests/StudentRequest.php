<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        $studentId = $this->route('student') ? $this->route('student')->id : null;

        return [
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:50|unique:students,nis,' . $studentId,
            'email' => 'nullable|email',
            'kelas_id' => 'required|exists:kelas,id', // Changed from 'kelas' to 'kelas_id' and added exists validation
            'photo' => 'nullable|image|max:2048',
        ];
    }
}
