<?php

use App\Http\Controllers\AcceptAnswerController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\BookmarkQuestionController;
use App\Http\Controllers\QuestionController;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [QuestionController::class, 'index'])->name('questions.index');
Route::get('/questions/{question:slug}', [QuestionController::class, 'show'])->name('questions.show');
Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store')->middleware('auth');
Route::resource('questions', QuestionController::class)->middleware('auth')->except(['index', 'show', 'store']);
Route::resource('questions.answers', AnswerController::class)->middleware('auth')->only(['store', 'destroy', 'update']);
Route::post('/questions/answer/{answer}/accepted', AcceptAnswerController::class)->name('questions.answers.accept')->middleware('auth');

Route::post('/question/{question}/bookmark', [BookmarkQuestionController::class, 'store'])->name('questions.bookmark.store')->middleware('auth');
Route::delete('/question/{question}/bookmark', [BookmarkQuestionController::class, 'destroy'])->name('questions.bookmark.destroy')->middleware('auth');
