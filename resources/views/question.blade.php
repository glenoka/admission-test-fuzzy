


<h3 class="mb-4">{{ $currentQuestion->question->question }}</h3>

@foreach($currentQuestion->question->options as $option)
<div class="form-check mb-3">
    <input class="form-check-input" 
           type="radio" 
           name="answer_{{ $currentQuestion->id }}" 
           value="{{ $option->id }}"
           onchange="saveAnswer({{ $currentQuestion->question_id }}, {{ $option->id }})">
           
    <label class="form-check-label">
        {{ $option->option_text }}
    </label>
</div>
@endforeach