<?php

namespace Database\Seeders;

use App\Models\trackingTypes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class trackingtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tracking_types')->insert([
            ['tracking_type'=>'officer'],
            ['tracking_type'=>'section'],
        ]);
    }
}
