<?php

namespace Database\Seeders;

use App\Models\BaseCategory;
use Illuminate\Database\Seeder;

class BaseCategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BaseCategory::insert([
            ["name_ar" => "الحماية من التسلل", "name_en" => "Intrusion protection", "image" => "1.svg"],
            ["name_ar" => "الكشف عن الحرائق", "name_en" => "Fire detection", "image" => "2.svg"],
            ["name_ar" => "حماية من التسرب", "name_en" => "Leak protection", "image" => "3.svg"],
            ["name_ar" => "حماية خارجية", "name_en" => "Outdoor Security", "image" => "4.svg"],
            ["name_ar" => "الراحة والإنتاجية", "name_en" => "Comfort and productivity", "image" => "5.svg"],
            ["name_ar" => "صفارات الإنذار", "name_en" => "Sirens", "image" => "6.svg"],
            ["name_ar" => "الظوابط", "name_en" => "Controls", "image" => "7.svg"],
            ["name_ar" => "التشغيل الالي", "name_en" => "Automation", "image" => "8.svg"],
            ["name_ar" => "وحدات التكامل", "name_en" => "Integration modules", "image" => "9.svg"],
            ["name_ar" => "موسعات النطاق", "name_en" => "Range extenders", "image" => "10.svg"],
            ["name_ar" => "وحدات إمداد الطاقة", "name_en" => "Power supply units", "image" => "11.svg"]
        ]);
    }
}
