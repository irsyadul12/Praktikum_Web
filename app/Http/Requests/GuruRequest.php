<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuruRequest extends FormRequest
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
        $guruId = $this->route('guru') ? $this->route('guru')->id : null;

        return [
            'name' => 'required|string|max:255',
            'nuptk' => 'required|string|max:100|unique:gurus,nuptk,' . $guruId,
            'email' => 'required|email|unique:gurus,email,' . $guruId,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ];
    }
}
