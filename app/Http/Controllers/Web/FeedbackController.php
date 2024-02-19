<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request\web\FeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {

    $request->validate([
        'point1' => 'required',
        'point2' => 'required',
        'point3' => 'required',
        'point4' => 'required',
    ]);

    $feedback = new Feedback([
        'point1' => $request->input('point1'),
        'point2' => $request->input('point2'),
        'point3' => $request->input('point3'),
        'point4' => $request->input('point4'),
        'comments'=> $request->input('comments'),
        'serial' => "#SD-Store:" . substr(Str::uuid(), 0, 5),

    ]);
    $feedback->save();
    return response()->json(['success' => true, 'message' => 'Feedback submitted successfully!']);
    }

    public function index()
    {


    }

    // public function getAllFeedback()
    // {
    //     $feedbacks = Feedback::all();
    //     return response()->json(['feedbacks' => $feedbacks]);
    // }

    public function getAllFeedback()
    {
        $feedbacks = Feedback::with('install')->get();

        $formattedFeedbacks = $feedbacks->map(function ($feedback) {
            return [
                'id' => $feedback->id,
                'point1' => $feedback->point1,
                'point2' => $feedback->point2,
                'point3' => $feedback->point3,
                'point4' => $feedback->point4,
                'comments'=> $feedback->comments,
                'install_name' => $feedback->install ? $feedback->install->name : 'No Name',
                // Add other fields as needed

            ];
        });

        return response()->json(['feedbacks' => $formattedFeedbacks]);
    }
}
