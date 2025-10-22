<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('degrees', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Tên văn bằng, ví dụ: 'Kỹ sư', 'Cử nhân'
            $table->string('level');          // Bậc đào tạo, ví dụ: 'Đại học'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('degrees');
    }
};
