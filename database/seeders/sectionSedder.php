<?php

namespace Database\Seeders;

use App\Models\Sections;
use App\Models\status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class sectionSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = collect(
        [
            ['section'=>'DRA'],
            ['section'=>'HCG'],
            ['section'=>'ALC'],
            ['section'=>'Budget'],
            ['section'=>'Accounts'],
            ['section'=>'RDM'],
        ]);
        $sections->each(function($section){
            Sections::insert($section);
        });
        
        status::insert(['status'=>'Active']);
        status::insert(['status'=>'Deactive']);
    }
}
