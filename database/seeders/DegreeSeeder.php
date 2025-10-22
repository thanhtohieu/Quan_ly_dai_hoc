<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('degrees')->insert([
            [
                'name' => 'Cử nhân',
                'level' => 'Đại học',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kỹ sư',
                'level' => 'Đại học',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Thạc sĩ',
                'level' => 'Sau đại học',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
