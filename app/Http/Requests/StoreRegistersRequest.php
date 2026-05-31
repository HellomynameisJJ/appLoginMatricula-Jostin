<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRegistersRequest extends FormRequest
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
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:teachers,id',
            'schedule_id' => 'required|exists:schedules,id',
            'semester' => 'nullable|string|max:50',
            'registration_date' => 'nullable|date',
            'final_note' => 'nullable|integer',
            'status' => 'nullable|in:Aprobado,Reprobado,Cursando',
        ];
    }
}
