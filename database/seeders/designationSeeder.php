<?php

namespace Database\Seeders;

use App\Models\designations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class designationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        designations::create([[
            'designation'=>'Chief Commissioner, ICT',
        ],[
            'designation'=>'Deputy Commissioner, ICT',
        ],[
            'designation'=>'Addl. Deputy Commissioner (G), ICT',
        ],[
            'designation'=>'Addl. Deputy Commissioner (East), ICT',
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
