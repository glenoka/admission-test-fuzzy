<?php

use App\Livewire\AttemptExam;
use App\Livewire\AttemptExamEssay;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamAttemptController;

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/do-exam/{id}',AttemptExam::class)->name('do-exam');
    Route::get('/do-exam-essay/{id}',AttemptExamEssay::class)->name('do-exam-essay');
});
