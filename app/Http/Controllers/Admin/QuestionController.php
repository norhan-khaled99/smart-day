<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'question_ar' => 'required|string',
            'question_en' => 'required|string',
            'answer_ar' => 'required|string',
            'answer_en' => 'required|string',
        ]);

        $question = new Question([
            'question_ar' => $request->input('question_ar'),
            'question_en' => $request->input('question_en'),
            'answer_ar' => $request->input('answer_ar'),
            'answer_en' => $request->input('answer_en'),
        ]);

        $question->save();

        return response()->json(['message' => 'Question stored successfully', 'question' => $question]);
    }
    public function getAllQuestions()
    {
        $questions = Question::all();

        return response()->json(['questions' => $questions]);
    }

    public function deleteQuestion($id)
    {
        $question = Question::find($id);

        if (!$question) {
            return response()->json(['message' => 'Question not found'], 404);
        }
        $question->delete();
        return response()->json(['message' => 'Question deleted successfully']);
    }


}
