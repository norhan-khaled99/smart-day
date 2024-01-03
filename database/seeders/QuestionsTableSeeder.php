<?php

namespace Database\Seeders;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         for ($i = 1; $i <= 100; $i++) {
            Question::create([
                'question_ar' => "Question $i in Arabic",
                'question_en' => "Question $i in English",
                'answer_ar' => "Answer to Question $i in Arabic",
                'answer_en' => "Answer to Question $i in English",
            ]);
        }
    }
}
