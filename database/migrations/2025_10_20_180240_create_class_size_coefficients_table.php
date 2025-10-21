<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_size_coefficients', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('min_students');
            $table->unsignedInteger('max_students');
            $table->decimal('coefficient', 5, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_size_coefficients');
    }
};
