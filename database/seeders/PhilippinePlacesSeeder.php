<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhilippinePlacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! DB::table('philippine_regions')->count()) {
            DB::unprepared(file_get_contents(__DIR__.'/sql/philippine_regions.sql'));
        }
        if (! DB::table('philippine_provinces')->count()) {
            DB::unprepared(file_get_contents(__DIR__.'/sql/philippine_provinces.sql'));
        }
        if (! DB::table('philippine_cities')->count()) {
            DB::unprepared(file_get_contents(__DIR__.'/sql/philippine_cities.sql'));
        }
    }
}
