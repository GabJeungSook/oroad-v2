<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurposeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('purposes')->insert([
            [
                'name' => 'For Licensure examination',
            ],
            [
                'name' => 'For Transfer/evaluation',
            ],
            [
                'name' => 'For Enrollment',
            ],
            [
                'name' => 'For Employment',
            ],
            [
                'name' => 'Promotion',
            ],
            [
                'name' => 'Scholarship',
            ],
            [
                'name' => 'Others',
            ],
        ]);
    }
}
