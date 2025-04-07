<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Package_question;
use App\Models\Exam_Answer;

class ExamAttemptController extends Controller
{
    public function doExam(Request $request, $id){
        $getDataExam=Exam::where('slug', $id)->first();
        $getQuestion=Package_question::where('package_id', $getDataExam->package_id)->with('question')->get();
       
    return view('attemptExam');


    }
}
