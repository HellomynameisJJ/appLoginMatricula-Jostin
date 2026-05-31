<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentsRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'DNI' => [
                'required',
                'string',
                'max:8',
                Rule::unique('students', 'DNI')->ignore($this->route('student'))
            ],
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('students', 'email')->ignore($this->route('student'))
            ],
            'registration_status' => 'nullable|in:Matriculado,Inactivo',
        ];
    }
}
