<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamAttemptController;
use App\Livewire\AttemptExam;

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/do-exam/{id}',AttemptExam::class)->name('do-exam');
});
