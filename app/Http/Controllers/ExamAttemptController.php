<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamAttemptController extends Controller
{
    public function doExam(Request $request, $id){
        return ("Do Exam");
    }
}
