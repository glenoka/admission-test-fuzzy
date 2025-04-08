<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamAttemptController;

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/do-tryout/{id}', [ExamAttemptController::class,'doExam'])->name('do-tryout');
    Route::get('/tryout/{package}/{question}', [ExamAttemptController::class, 'getQuestion'])->name('tryout.question');
    Route::post('/tryout/save', [ExamAttemptController::class, 'saveAnswer'])->name('tryout.save');
    Route::post('/tryout/submit', [ExamAttemptController::class, 'submit'])->name('tryout.submit');
});
