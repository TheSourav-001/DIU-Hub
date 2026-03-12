<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            // Expanded Profile Fields
            'student_id' => ['nullable', 'string', 'max:20'],
            'avatar' => ['nullable', 'image', 'max:5120'], // 5MB max
            'dob' => ['nullable', 'date'],
            'blood_group' => ['nullable', 'string', 'max:5'],
            'national_id' => ['nullable', 'string', 'max:30'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'program' => ['nullable', 'string', 'max:100'],
            'current_semester' => ['nullable', 'string', 'max:50'],
            'academic_advisor' => ['nullable', 'string', 'max:100'],
            'cgpa' => ['nullable', 'numeric', 'min:0', 'max:4.00'],
            'personal_email' => ['nullable', 'email', 'max:100'],
            'phone' => ['nullable', 'string', 'max:20'],
            'present_address' => ['nullable', 'string'],
            'permanent_address' => ['nullable', 'string'],
            'emergency_contact_name' => ['nullable', 'string', 'max:100'],
            'emergency_contact_phone' => ['nullable', 'string', 'max:20'],
            'payment_ledger' => ['nullable', 'string', 'max:100'],
            'scholarship_details' => ['nullable', 'string'],
            'transaction_history' => ['nullable', 'string'],
            'class_routine_link' => ['nullable', 'string', 'max:255'],
            'lms_link' => ['nullable', 'string', 'max:255'],
            'attendance_percentage' => ['nullable', 'integer', 'min:0', 'max:100'],
            'course_registration' => ['nullable', 'string'],
        ];
    }
}
