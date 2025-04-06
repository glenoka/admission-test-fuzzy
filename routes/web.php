<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamAttemptController;

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/do-tryout/{id}', [ExamAttemptController::class,'doExam'])->name('do-tryout');
});
