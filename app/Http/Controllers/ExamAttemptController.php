<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Package_question;
use App\Models\Exam_Answer;
use App\Models\Package;
use App\Models\Question_Option;

class ExamAttemptController extends Controller
{
    public function doExam($id){
       
        $getDataExam=Exam::where('slug', $id)->first();
       
        $Package = Package::with('package_questions.question.options')->findOrFail($getDataExam->package_id);

        $updateStartedExam=Exam::where('package_id',$Package->id)->update(['started_at'=>now()]);
       foreach ($Package->package_questions as $item) {
        $addAnswerExamFirst=Exam_Answer::create([
            'exam_id'=> $getDataExam->id,
            'question_id'=>$item->question->id,
            'option_id'=> null,
            'essay_answer'=>null,
            'score'=> 0
        ]);
       }
       $selectedAnswers = $this->getSelectedAnswers($getDataExam);
    return view('attemptExam',[
        'package' => $Package,
        'questions' => $Package->package_questions,
        'currentQuestion' => $Package->package_questions->first(),
        'timeLeft' => $this->calculateTimeLeft($getDataExam),
        'selectedAnswers' => $selectedAnswers
    ]);

    }
    private function getSelectedAnswers($getDataExam)
    {
        return Exam_Answer::where('exam_id', $getDataExam->id)
            ->pluck('option_id', 'question_id')
            ->toArray();
    }
    private function calculateTimeLeft($getDataExam)
    {
        if ($getDataExam->finished_at) return 0;
        
        $now = time();
        $startedAt = strtotime($getDataExam->started_at);
        return max(0, $getDataExam->duration - ($now - $startedAt));
    }



    public function getQuestion($packageId, $questionId)
    {
  
        $question = Package_Question::with('question.options')
        ->where('package_id', $packageId)
        ->findOrFail($questionId);
        return response()->json([
            'html' => view('question', [
                'currentQuestion' => $question,
                'currentQuestionId' => $question->id
            ])->render()
        ]);
    }
   
    public function saveAnswer(Request $request)
    {
        $validated = $request->validate([
            'question_id' => 'required|integer',
            'option_id' => 'required|integer'
        ]);

        $score = Question_Option::find($validated['option_id'])->score ?? 0;

        Exam_Answer::updateOrCreate(
            [
                'exam_id' => $request->exam->id,
                'question_id' => $validated['question_id']
            ],
            [
                'option_id' => $validated['option_id'],
                'score' => $score
            ]
        );

        return response()->json(['status' => 'success']);
    }

    public function submit(Request $request)
    {
        Exam::find($request->exam->id)->update(['finished_at' => now()]);
        return redirect()->route('tryout.result')->with('success', 'Tryout submitted!');
    }

   
}
