<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resource_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('course_code', 20);
            $table->string('department');
            $table->string('semester', 50);
            $table->string('resource_type', 50);
            $table->text('description')->nullable();
            $table->string('status', 20)->default('pending'); // pending | fulfilled
            $table->timestamps();

            $table->index('status');
            $table->index('course_code');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resource_requests');
    }
};
