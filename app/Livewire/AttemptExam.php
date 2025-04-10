<?php

namespace App\Livewire;

use App\Models\Exam;
use App\Models\Exam_Answer;
use App\Models\Package;
use Livewire\Component;
use App\Models\Question_Option;
use App\Models\Package_Question;

class AttemptExam extends Component
{
    public $examQuestion;
    public $Exam;
    public $currentQuestion;
    public $Questions;
    public $selectedAnswers = [];
    public $Exam_Answer;
    

    public function mount($id){
        $this->Exam=Exam::where('slug', $id)->first();
        if($this->Exam->started_at==null){
            $startedAt = now();
            Exam::where('slug',$id)->update([
                'started_at' => $startedAt,
            ]);
        }
        $this->examQuestion = Package::with('package_questions.question.options')->find($this->Exam->package_id);
        if ($this->Exam) {
            $this->Questions = $this->examQuestion->package_questions;
            if ($this->Questions->isNotEmpty()) {
                $this->currentQuestion = $this->Questions->first();
            }
        }

        //Check apakah sudah ada jawaban sebelumnya
        $is_exist_exam_answer=Exam_Answer::where('exam_id', $this->Exam->id)->first();
        if (!$is_exist_exam_answer) {
            foreach($this->Questions as $question){
                $addAnswerExamFirst=Exam_Answer::create([
                    'exam_id'=> $this->Exam->id,
                    'question_id'=>$question->question_id,
                    'option_id'=> null,
                    'essay_answer'=>null,
                    'score'=> 0
                ]);
            }
        }

        $this->Exam_Answer = Exam_Answer::where('exam_id', $this->Exam->id)->get();
        foreach($this->Exam_Answer as $answer) {
            $this->selectedAnswers[$answer->question_id] = $answer->option_id;

        }
          
    }


    public function goToQuestion($question_id)
    {
      
        $this->currentQuestion = $this->Questions->where('question_id', $question_id)->first();
     
        
    }
    public function saveAnswer($questionId, $optionId)
    {
        
        $option = Question_Option::find($optionId);
        $score = $option->score ?? 0;

        $tryOutAnswer = Exam_Answer::where('exam_id', $this->Exam->id)
                                ->where('question_id', $questionId)
                                ->first();
        if ($tryOutAnswer) {
            $tryOutAnswer->update([
                'option_id' => $optionId,
                'score' => $score
            ]);
        }
    }
    public function render()
    {
        return view('livewire.attempt-exam');
    }
}
