<div>

    <div class="container">
        <!-- Timer -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Sisa Waktu</h5>
                <div id="timer" class="display-4 text-danger">
                    Time Left : 00:00:00
                </div>
            </div>
        </div>
        <div class="question-nav mb-4 d-flex flex-wrap gap-2" id="questionNav">

            {{ $currentPackageQuestion->question_id }}

            @foreach ($Questions as $index => $question)
                <button
                    class="btn btn-sm {{ $question->question_id == $currentPackageQuestion->question_id ? 'btn-primary' : 'btn-outline-primary' }}"
                    data-question-id="{{ $question->question_id }}"
                    wire:click="goToQuestion({{ $question->question_id }})">
                    {{ $index + 1 }}
                </button>
            @endforeach
        </div>

        <h3 class="mb-4">{{ $currentPackageQuestion->question->question }}</h3>

        @foreach ($currentPackageQuestion->question->options as $option)
            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="answer_{{ $currentPackageQuestion->question_id }}"
                    value="{{ $option->id }}" wire:key="{{ $option->id }}"
                    wire:click="saveAnswer({{ $currentPackageQuestion->question_id }}, {{ $option->id }})"
                    @if ($selectedAnswers[$currentPackageQuestion->question_id] == $option->id) checked @endif>
               
                <label class="form-check-label">
                    {{ $option->option_text }}
                </label>
            </div>
        @endforeach
        Question ID : {{ $currentPackageQuestion->question_id }}
        Option ID : {{ $selectedAnswers[$currentPackageQuestion->question_id] }}
        <div class="mt-3">
            <pre>{{ json_encode($selectedAnswers, JSON_PRETTY_PRINT) }}</pre>
        </div>
    </div>
</div>
