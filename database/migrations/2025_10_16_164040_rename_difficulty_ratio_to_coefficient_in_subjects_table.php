<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->float('coefficient')->nullable();
        });

        // Copy dữ liệu từ cột cũ sang cột mới
        DB::statement('UPDATE subjects SET coefficient = difficulty_ratio');

        // Xóa cột cũ
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropColumn('difficulty_ratio');
        });
    }

    public function down(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->float('difficulty_ratio')->nullable();
        });

        DB::statement('UPDATE subjects SET difficulty_ratio = coefficient');

        Schema::table('subjects', function (Blueprint $table) {
            $table->dropColumn('coefficient');
        });
    }
};
