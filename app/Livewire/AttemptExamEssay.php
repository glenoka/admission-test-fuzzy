<?php

namespace App\Livewire;

use App\Models\Exam;
use App\Models\Package;
use Livewire\Component;
use App\Models\Exam_Answer;

class AttemptExamEssay extends Component
{

    public $examQuestion;
    public $Exam;
    public $currentPackageQuestion;
    public $Questions;
    public $answerEssay = [];
    public $Exam_Answer;
    public $Exam_id;
    public $timeLeft;
    

    public function mount($id)
    {
        $this->Exam_id = $id;
        
        $this->Exam=Exam::where('slug', $id)->first();
        if($this->Exam->started_at==null){
            $startedAt = now();
            Exam::where('slug',$id)->update([
                'started_at' => $startedAt,
            ]);
        }
        $this->examQuestion = Package::with('package_questions.question.options')->find($this->Exam->package_id);
        if ($this->examQuestion) {
            $this->Questions = $this->examQuestion->package_questions;
            if ($this->Questions->isNotEmpty()) {
                $this->currentPackageQuestion = $this->Questions->first();
            }
        }
        //get jawaban essay
        $this->Exam_Answer = Exam_Answer::where('exam_id', $this->Exam->id)->where('question_id',$this->currentPackageQuestion->question_id)->first();
        if ($this->Exam_Answer) {
            $this->answerEssay[$this->currentPackageQuestion->question_id] = $this->Exam_Answer->essay_answer;
        } else {
            $this->answerEssay[$this->currentPackageQuestion->question_id] = null;
        }
        
        $this->calculateTimeLeft();
       

    }
    public function updateAnswer($questionId)
    {
       
        $updateAnswer = Exam_Answer::where('exam_id', $this->Exam->id)->where('question_id', $questionId)->first();
        if ($updateAnswer) {
            $updateAnswer->essay_answer = $this->answerEssay[$questionId];
            $updateAnswer->save();
        } else {
            Exam_Answer::create([
                'exam_id' => $this->Exam->id,
                'question_id' => $questionId,
                'option_id' => null,
                'essay_answer' => $this->answerEssay[$questionId],
                'score' => 0
            ]);
        }
    }
    
    public function goToQuestion($questionId)
    {
        //simpan jawaban sebelumnya 
        
        $this->currentPackageQuestion = $this->Questions->where('question_id', $questionId)->first();
        $this->Exam_Answer = Exam_Answer::where('exam_id', $this->Exam->id)->where('question_id',$questionId)->first();
        if ($this->Exam_Answer) {
            $this->answerEssay[$questionId] = $this->Exam_Answer->essay_answer;
        } else {
            $this->answerEssay[$questionId] = null;
        }
        
        
        $this->calculateTimeLeft();
    }
    protected function calculateTimeLeft()
    {
        if ($this->Exam->finished_at) {
            $this->timeLeft = 0;
            
        } else {
            $now = time();
            $startedAt = strtotime($this->Exam->started_at);
    
            $sisaWaktu = $now - $startedAt;
           
            if ($sisaWaktu < 0) {
                $this->timeLeft = 0;
            } else {
                $this->timeLeft = max(0, ($this->Exam->duration*60) - $sisaWaktu);
            }
        }

       
    }
    public function render()
    {
        return view('livewire.attempt-exam-essay');
    }
}
