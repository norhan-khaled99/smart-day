<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::insert([
            ["name" => "الوسطى", "name_e" => "Central"],
            ["name" => "الغربية", "name_e" => "Western"],
            ["name" => "الجنوبية", "name_e" => "Southern"],
            ["name" => "الشمالية", "name_e" => "Northern"],
            ["name" => "الشرقية", "name_e" => "Eastern"],
        ]);
    }
}
