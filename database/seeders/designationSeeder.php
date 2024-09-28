<?php

namespace Database\Seeders;

use App\Models\designations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class designationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('designations')->insert([[
            'designation'=>'Chief Commissioner, ICT',
        ],[
            'designation'=>'Deputy Commissioner, ICT',
        ],[
            'designation'=>'Addl. Deputy Commissioner (G), ICT',
        ],[
            'designation'=>'Addl. Deputy Commissioner (E), ICT',
        ],[
            'designation'=>'Addl. Deputy Commissioner (R), ICT',
        ],[
            'designation'=>'Assistant Commissioner (Potohar), ICT',
        ],[
            'designation'=>'Assistant Commissioner (Sectt.), ICT',
        ],[
            'designation'=>'Assistant Commissioner (Potohar), ICT',
        ],[
            'designation'=>'Assistant Commissioner (Rural), ICT',
        ],[
            'designation'=>'Assistant Commissioner (City), ICT',
        ],[
            'designation'=>'Assistant Commissioner (Potohar), ICT',
        ]]);
    }
}
