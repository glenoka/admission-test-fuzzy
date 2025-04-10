@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Timer -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Sisa Waktu</h5>
                <div id="timer" class="display-4 text-danger">
                    {{ gmdate('H:i:s', $timeLeft) }}
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="question-nav mb-4 d-flex flex-wrap gap-2" id="questionNav">
            @foreach ($questions as $index => $question)
                <button
                    class="btn btn-sm {{ $question->id == $currentQuestion->id ? 'btn-primary' : 'btn-outline-primary' }}"
                    data-question-id="{{ $question->id }}" onclick="loadQuestion({{ $question->id }})">
                    {{ $index + 1 }}
                </button>
            @endforeach
        </div>

        <!-- Question Container -->
        <div class="card">
            <div class="card-body" id="questionContainer">
                @include('question', [
                    'currentQuestion' => $currentQuestion,
                    'selectedAnswers' => $selectedAnswers,
                ])
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-4 text-center">
            <button class="btn btn-lg btn-danger" onclick="submitTryout()">
                Selesaikan Tryout
            </button>
        </div>
    </div>

    <script>
        // AJAX Functions
        function loadQuestion(questionId) {
            fetch(`/tryout/{{ $package->id }}/${questionId}`)
                .then(response => response.json())
                .then(data => {
                    console.log({{ $currentQuestion->id }});

                    document.getElementById('questionContainer').innerHTML = data.html;

                    // Update navigation buttons
                    document.querySelectorAll('.question-nav .btn').forEach((btn, index) => {
                        btn.classList.remove('btn-primary');
                        btn.classList.add('btn-outline-primary');
                        if (index === (questionId - 1)) {
                            btn.classList.add('btn-primary');
                            btn.classList.remove('btn-outline-primary');
                        }
                    });
                });
        }

        function saveAnswer(questionId, optionId) {
            fetch("{{ route('tryout.save') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    question_id: questionId,
                    option_id: optionId
                })
            });
        }

        // Timer
        let timeLeft = {{ $timeLeft }};
        const timerElement = document.getElementById('timer');

        setInterval(() => {
            if (timeLeft <= 0) return;
            timeLeft--;

            const hours = Math.floor(timeLeft / 3600);
            const minutes = Math.floor((timeLeft % 3600) / 60);
            const seconds = timeLeft % 60;

            timerElement.textContent =
                `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }, 1000);

        function submitTryout() {
            if (confirm('Yakin ingin menyelesaikan tryout?')) {
                window.location.href = "{{ route('tryout.submit') }}";
            }
        }
    </script>
@endsection
