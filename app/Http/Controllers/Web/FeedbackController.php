<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request\web\FeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {

    // $validatedData = $request->validated();

    $request->validate([
        'point1' => 'required',
        'point2' => 'required',
        'point3' => 'required',
        'point4' => 'required',
    ]);

    // Create a new Feedback instance with the request data
    $feedback = new Feedback([
        'point1' => $request->input('point1'),
        'point2' => $request->input('point2'),
        'point3' => $request->input('point3'),
        'point4' => $request->input('point4'),
        'comments'=> $request->input('comments')
        // Add other fields as needed
    ]);
    // $feedback = new Feedback();
    $feedback->save();
    return response()->json(['success' => true, 'message' => 'Feedback submitted successfully!']);
    }

    public function index()
    {


    }

    public function getAllFeedback()
    {
        $feedbacks = Feedback::all();
        return response()->json(['feedbacks' => $feedbacks]);
    }
}
