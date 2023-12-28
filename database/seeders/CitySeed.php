<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::insert([
            ["name"=>"ابها","name_e"=>"Abha"],
            ["name"=>"بقيق","name_e"=>"Abqaiq"],
            ["name"=>"الباحة","name_e"=>"Al-Bahah"],
            ["name"=>"الدمام","name_e"=>"Al-Dammam"],
            ["name"=>"الهفهوف","name_e"=>"Al-Hufuf"],
            ["name"=>"الجوف","name_e"=>"Al-Jawf"],
            ["name"=>"الخرج","name_e"=>"Al-Kharj"],
            ["name"=>"الخبر","name_e"=>"Al-Khubar"],
            ["name"=>"القطيف","name_e"=>"Al-Qatif"],
            ["name"=>"الطائف","name_e"=>"Al-Taif"],
            ["name"=>"عرعر","name_e"=>"Arar"],
            ["name"=>"بريدة","name_e"=>"Buraydah"],
            ["name"=>"الظهران","name_e"=>"Dhahran"],
            ["name"=>"يشيد","name_e"=>"Hail"],
            ["name"=>"جدة","name_e"=>"Jiddah"],
            ["name"=>"جازان","name_e"=>"Jizan"],
            ["name"=>"خميس مشيط","name_e"=>"Khamis Mushayt"],
            ["name"=>"مدينة الملك خالد العسكرية","name_e"=>"King Khalid Military City"],
            ["name"=>"مكة المكرمة","name_e"=>"Mecca"],
            ["name"=>"المدينة المنورة","name_e"=>"Medina"],
            ["name"=>"نجران","name_e"=>"Najran"],
            ["name"=>"رأس تنورة","name_e"=>"Ras Tanura"],
            ["name"=>"الرياض","name_e"=>"Riyadh"],
            ["name"=>"سكاكا","name_e"=>"Sakaka"],
            ["name"=>"تبوك","name_e"=>"Tabuk"],
            ["name"=>"ينبع","name_e"=>"Yanbu"],
        ]);
    }
}
