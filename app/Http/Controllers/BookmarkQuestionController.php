<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use function Symfony\Component\String\b;

class BookmarkQuestionController extends Controller
{

    public function store(Question $question, Request $request)
    {
        $question->bookmarks()->attach($request->user()->id);

        return back()->with('success', 'The Question Has Been Bookmarked');
    }

    public function destroy(Question $question, Request $request)
    {
        $question->bookmarks()->detach($request->user()->id);

        return back()->with('success', 'The question has been removed from bookmarked.');
    }


}
