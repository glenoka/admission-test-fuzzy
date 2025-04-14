<div>
    <style>
        :root {
            --primary: #4A90E2;
            --secondary: #F5F6FA;
            --text: #2D3436;
        }

        body {
            margin: 0;
            padding: 90px 20px 20px;
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
            color: var(--text);
        }

        #countdown {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: white;
            padding: 15px;
            text-align: center;
            font-size: 40px;
            font-weight: 600;
            color: var(--primary);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            z-index: 1000;
        }

        .container {
            display: flex;
            gap: 30px;
            max-width: 1200px;
            margin: 30px auto;
        }

        .soal-container {
            flex: 3;
        }

        .navigation-container {
            flex: 1;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            border: 1px solid #eee;
        }

        .soal-number {
            color: var(--primary);
            font-size: 18px;
            margin-bottom: 15px;
        }

        .question-text {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        /* Custom Radio Button Styling */
        .radio-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .radio-input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .radio-label {
            display: flex;
            align-items: center;
            padding: 15px;
            border-radius: 8px;
            border: 2px solid #e0e0e0;
            cursor: pointer;
            transition: all 0.2s ease;
            background: white;
        }

        .radio-label:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .radio-input:checked+.radio-label {
            border-color: var(--primary);
            background-color: rgba(74, 144, 226, 0.05);
        }

        .custom-radio {
            width: 20px;
            height: 20px;
            border: 2px solid #ddd;
            border-radius: 50%;
            margin-right: 15px;
            position: relative;
            transition: all 0.2s ease;
        }

        .radio-input:checked+.radio-label .custom-radio {
            border-color: var(--primary);
            background-color: var(--primary);
        }

        .custom-radio::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 10px;
            height: 10px;
            background: white;
            border-radius: 50%;
            opacity: 0;
            transition: all 0.2s ease;
        }

        .radio-input:checked+.radio-label .custom-radio::after {
            opacity: 1;
        }

        /* Navigation Buttons */
        .nav-buttons {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
        }

        .nav-button {
            width: 45px;
            height: 45px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            background: white;
            color: var(--text);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .nav-button:hover {
            border-color: var(--primary);
            transform: scale(1.05);
        }

        .nav-button.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        #submit {
            margin-top: 25px;
            width: 100%;
            padding: 15px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        #submit:hover {
            background: #357ABD;
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
        }
    </style>
    <div id="countdown">00:00:00</div>
    <div class="container">
        <div class="soal-container">
            <div class="card">
                <div class="soal">
                    <p> {{ $currentPackageQuestion->question->question }}</p>
                    <textarea
                        wire:model.debounce.500ms="answerEssay.{{ $currentPackageQuestion->question_id }}"
                        class="form-control"
                        wire:key="answerEssay-{{ $currentPackageQuestion->question_id }}"
                        wire:change="updateAnswer({{ $currentPackageQuestion->question_id }})"
                        rows="10"
                        placeholder="Tulis jawaban anda disini...">
                    </textarea>
                </div>
            </div>
        </div>
        <div class="navigation-container">
            <div class="card">
                <div class="nav-buttons" id="navButtons">
                    @foreach ($Questions as $index => $question)
                    <button
                        class="btn btn-sm {{ $question->question_id == $currentPackageQuestion->question_id ? 'btn-primary' : 'btn-outline-primary' }}"
                        data-question-id="{{ $question->question_id }}"
                        wire:click="goToQuestion({{ $question->question_id }},{{$currentPackageQuestion->question_id}})">
                        {{ $index + 1 }}
                    </button>
                    @endforeach
                </div>
                <button wire:click="submit" onclick="return confirm('Apakah anda yakin ingin mengirim jawaban ini?')" id="submit">Submit Exam</button>
            </div>
        </div>


    </div>
    @if(session()->has('message'))
    <div class="alert alert-success text-center">
        {{ session('message') }} <a href="{{url('admin/tryouts')}}">Lihat Hasil Pengerjaan</a>
    </div>
    @endif
</div>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            let timeLeft = {{ $timeLeft }};
            startCountdown(timeLeft, document.getElementById('countdown'));
        });

        function startCountdown(duration, display) {
            let timer = duration,
                minutes, seconds;
            setInterval(function() {
                hours = parseInt(timer / 3600, 10);
                minutes = parseInt((timer % 3600) / 60, 10);
                seconds = parseInt(timer % 60, 10);

                hours = hours < 10 ? "0" + hours : hours;
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = hours + ":" + minutes + ":" + seconds;

                if (--timer < 0) {
                    timer = 0;
                }
            }, 1000);
        }
    </script>
</div>