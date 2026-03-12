<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            // 1. Personal Information
            $table->string('student_id')->nullable();
            $table->string('avatar')->nullable();
            $table->date('dob')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('national_id')->nullable();
            
            // 2. Academic Information
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->string('program')->nullable();
            $table->string('current_semester')->nullable();
            $table->string('academic_advisor')->nullable();
            $table->decimal('cgpa', 4, 2)->nullable();
            
            // 3. Contact & Address Details
            $table->string('personal_email')->nullable();
            $table->string('phone')->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            
            // 4. Financial Information
            $table->string('payment_ledger')->nullable();
            $table->text('scholarship_details')->nullable();
            $table->text('transaction_history')->nullable();
            
            // 5. Academic & Portal Tools
            $table->string('class_routine_link')->nullable();
            $table->text('course_registration')->nullable();
            $table->integer('attendance_percentage')->nullable();
            $table->string('lms_link')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
