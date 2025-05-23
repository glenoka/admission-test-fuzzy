<?php

use App\Livewire\AttemptExam;
use App\Livewire\AttemptExamEssay;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamAttemptController;
use App\Livewire\HomePage;
use App\Livewire\RegisterPage;
use App\Livewire\ScoringEssay;

Route::get('/', HomePage::class)->name('home');
Route::get('/daftar-formasi', RegisterPage::class)->name('register-page');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/do-exam/{id}',AttemptExam::class)->name('do-exam');
    Route::get('/do-exam-essay/{id}',AttemptExamEssay::class)->name('do-exam-essay');
});


