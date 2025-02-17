<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class  AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnswerRequest $request, Question $question)
    {
        $request->validated();

        Answer::create([
            'user_id' => $request->user()->id,
            'body' => $request->body,
            'question_id' => $question->id
        ]);

        return back()->with('success', 'Your answer has been sent');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnswerRequest $request,Question $question, Answer $answer)
    {
        Gate::authorize('update', $answer);
        $answer->update($request->validated());

        return back()->with('success', 'Your answer has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question, Answer $answer)
    {
        Gate::authorize('update', $answer);
        $answer->delete();

        return back()->with('success', 'Your answer has been deleted');
    }
}
