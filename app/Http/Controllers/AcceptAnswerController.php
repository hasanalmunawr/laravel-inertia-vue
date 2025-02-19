<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AcceptAnswerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Answer $answer, Request $request)
    {
        $question = $answer->question; // Ambil model Question
        $question->acceptAnswer($answer); // Panggil metode acceptAnswer

        return back()->with('success', 'The answer has been marked as best');
    }
}
