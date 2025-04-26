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
    public $currentPackageQuestion;
    public $Questions;
    public $Exam_Answer;
    public $timeLeft;
    public $answerEssay=[];
    public $selectedAnswers = [];
    
    public function mount($id){
        $this->Exam=Exam::where('slug', $id)->first();
        if($this->Exam->started_at==null){
            $startedAt = now();
            Exam::where('slug',$id)->update([
                'started_at' => $startedAt,
            ]);
            // Refresh the model instance
        $this->Exam->refresh();
        }else{
            $this->timeLeft=0;
        }
       
        $this->examQuestion = Package::with('package_questions.question.options')->find($this->Exam->package_id);
        if ($this->examQuestion) {
            $this->Questions = $this->examQuestion->package_questions;
            if ($this->Questions->isNotEmpty()) {
                $this->currentPackageQuestion = $this->Questions->first();
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
       
       $this->reloadAnswer();
       $this->calculateTimeLeft();
       
     
    }
    public function reloadAnswer(){
        $this->Exam_Answer = Exam_Answer::where('exam_id', $this->Exam->id)->get();
        foreach($this->Exam_Answer as $answer) {
            $this->selectedAnswers[$answer->question_id] = $answer->option_id;

        }
    }

    public function goToQuestion($question_id)
    {

        $this->currentPackageQuestion = $this->Questions->where('question_id', $question_id)->first();
        $this->calculateTimeLeft();

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
        $this->selectedAnswers[$questionId] = $optionId;
    }
    protected function calculateTimeLeft()
    {
        
        if ($this->Exam->finish_at!=null) {
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
    public function submit()
    {
        $totalScore=Exam_Answer::where('exam_id', $this->Exam->id)->sum('score');
        $this->Exam->update(['total_score' => $totalScore]);
        $this->Exam->update(['finish_at' => now()]);
        $this->Exam->refresh();
      
        $this->timeLeft = 0;
        $this->calculateTimeLeft();
        
        session()->flash('message', 'Data berhasil disimpan');
        $this->dispatch('examFinished');
    }
    public function render()
    {
        return view('livewire.attempt-exam');
    }
}
