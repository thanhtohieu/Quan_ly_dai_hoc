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
        Schema::create('class_sections', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Mã lớp học phần, ví dụ PHYS10111

            // Các khóa ngoại cần thiết
            $table->foreignId('course_offering_id')->constrained('course_offerings')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
            $table->foreignId('teaching_rate_id')->constrained('teaching_rates')->onDelete('cascade');

            // Các thông tin khác
            $table->string('room')->nullable(); // Phòng học
            $table->integer('period_count')->default(0); // Số tiết
            $table->integer('student_count')->default(0); // Sĩ số

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_sections');
    }
};
