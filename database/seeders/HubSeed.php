<?php

namespace Database\Seeders;

use App\Models\Hub;
use Illuminate\Database\Seeder;

class HubSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hub::insert([
            [
                "name_ar" => "لوحة التحكم",
                "name_en" => "Hub",
                "ethernet" => 1,
                "wifi" => 0,
                "basic" => 1,
                "sim" => "2G",
                "with_photo" => 0,
                "scenarios" => 5,
                "cameras" => 10,
                "users" => 50,
                "description" => "لوحة تحكم نظام الامان",
            ],
            [
                "name_ar" => "لوحة التحكم (2)",
                "name_en" => "Hub (2)",
                "ethernet" => 1,
                "wifi" => 0,
                "basic" => 1,
                "sim" => "2G",
                "with_photo" => 1,
                "scenarios" => 32,
                "cameras" => 25,
                "users" => 50,
                "description" => "لوحة تحكم لنظام الأمان تدعم التحقق من الإنذار البصري",
            ],
            [
                "name_ar" => "لوحة التحكم (زائد)",
                "name_en" => "Hub Plus",
                "ethernet" => 1,
                "wifi" => 1,
                "basic" => 0,
                "sim" => "2G/3G",
                "with_photo" => 0,
                "scenarios" => 64,
                "cameras" => 50,
                "users" => 100,
                "description" => "لوحة التحكم لنظام الامان",
            ],
            [
                "name_ar" => "لوحة التحكم (2) (زائد)",
                "name_en" => "Hub Plus (2)",
                "ethernet" => 1,
                "wifi" => 1,
                "basic" => 0,
                "sim" => "2G/3G/4G (LTE)",
                "with_photo" => 1,
                "scenarios" => 64,
                "cameras" => 100,
                "users" => 200,
                "description" => "لوحة التحكم لنظام الامان",
            ],
        ]);
    }
}
