@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Timer Section -->
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 id="timer" class="mb-0">60:00</h3>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Soal No. <span id="currentQuestionNumber">1</span></h5>
                    </div>
                    <div class="card-body">
                        <!-- Soal -->
                        <div class="question-content">
                            <p>Apa ibu kota Indonesia?</p>
                        </div>

                        <!-- Pilihan Jawaban -->
                        <div class="options mt-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="answer" id="option1" value="1">
                                <label class="form-check-label" for="option1">
                                    Jakarta
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="answer" id="option2" value="2">
                                <label class="form-check-label" for="option2">
                                    Bandung
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="answer" id="option3" value="3">
                                <label class="form-check-label" for="option3">
                                    Surabaya
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="answer" id="option4" value="4">
                                <label class="form-check-label" for="option4">
                                    Yogyakarta
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Soal -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Navigasi Soal</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            @for ($i = 1; $i <= 10; $i++)
                                <button class="btn btn-outline-primary question-nav" data-question="{{ $i }}">
                                    Soal {{ $i }}
                                </button>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Timer functionality
        function startTimer(duration, display) {
            var timer = duration,
                minutes, seconds;
            setInterval(function() {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    // Submit form when timer reaches 0
                    document.getElementById('exam-form').submit();
                }
            }, 1000);
        }

        window.onload = function() {
            var minutes = 60; // Set timer duration in minutes
            var display = document.querySelector('#timer');
            startTimer(minutes * 60, display);
        };

        // Navigation functionality
        document.querySelectorAll('.question-nav').forEach(button => {
            button.addEventListener('click', function() {
                const questionNumber = this.dataset.question;
                // Add your navigation logic here
                // You can use AJAX to load the question or redirect to the specific question
            });
        });
    </script>
@endpush
