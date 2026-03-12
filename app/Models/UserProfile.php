<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'student_id',
        'avatar',
        'dob',
        'blood_group',
        'national_id',
        'department_id',
        'program',
        'current_semester',
        'academic_advisor',
        'cgpa',
        'personal_email',
        'phone',
        'present_address',
        'permanent_address',
        'emergency_contact_name',
        'emergency_contact_phone',
        'payment_ledger',
        'scholarship_details',
        'transaction_history',
        'class_routine_link',
        'course_registration',
        'attendance_percentage',
        'lms_link',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
