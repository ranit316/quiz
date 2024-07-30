@extends('layout.app')
@section('title', $page)
@section('content')
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        @foreach ($quizzes as $quiz)
            <div class="col-md-4">
                <div class="dashboard-item">
                    <h5>{{ $quiz->title }}</h5>
                    <p>{{ $quiz->description }}</p>
                    @auth
                        <button class="btn btn-primary" onclick="startQuiz({{ $quiz->id }})">Attempt Quiz</button>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal Start -->
    <div class="modal fade" id="quizModal" tabindex="-1" aria-labelledby="quizModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="quizModalLabel">Quiz</h5>
                    <span id="timer" class="ms-auto">Time left: 00:00</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="quizForm">
                        @csrf
                        <input type="hidden" id="quizId" name="quiz_id">
                        <div id="questionContainer"></div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary" id="prevButton" onclick="prevQuestion()">Previous</button>
                            <button type="button" class="btn btn-primary" id="nextButton" onclick="nextQuestion()">Next</button>
                            <button type="button" class="btn btn-success" id="submitButton" onclick="submitQuiz()" style="display: none;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let questions = [];
            let currentQuestionIndex = 0;
            let timer;
            let timeLeft;
            let selectedAnswers = {};

            window.startQuiz = function(quizId) {
                fetch(`/quizzes/${quizId}/questions`)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Received data:', data);
                        questions = data.questions;
                        timeLeft = data.duration * 60;
                        currentQuestionIndex = 0;
                        document.getElementById('quizId').value = quizId;
                        showQuestion();
                        $('#quizModal').modal('show');
                        startTimer();
                    });
            }

            function startTimer() {
                timer = setInterval(() => {
                    if (timeLeft <= 0) {
                        clearInterval(timer);
                        submitQuiz();
                    } else {
                        timeLeft--;
                        const minutes = Math.floor(timeLeft / 60).toString().padStart(2, '0');
                        const seconds = (timeLeft % 60).toString().padStart(2, '0');
                        document.getElementById('timer').textContent = `Time left: ${minutes}:${seconds}`;
                    }
                }, 1000);
            }

            function showQuestion() {
                const questionContainer = document.getElementById('questionContainer');
                if (questions[currentQuestionIndex]) {
                    const question = questions[currentQuestionIndex];
                    const options = JSON.parse(question.options);

                    questionContainer.innerHTML = `
                        <h5>${question.question}</h5>
                        ${Object.keys(options).map((key, index) => `
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer${currentQuestionIndex}" id="option${currentQuestionIndex}_${index}" value="${options[key]}" ${selectedAnswers[currentQuestionIndex] === options[key] ? 'checked' : ''}>
                                <label class="form-check-label" for="option${currentQuestionIndex}_${index}">${options[key]}</label>
                            </div>
                        `).join('')}
                    `;

                    document.getElementById('prevButton').style.display = currentQuestionIndex > 0 ? 'inline-block' : 'none';
                    document.getElementById('nextButton').style.display = currentQuestionIndex < questions.length - 1 ? 'inline-block' : 'none';
                    document.getElementById('submitButton').style.display = currentQuestionIndex === questions.length - 1 ? 'inline-block' : 'none';
                } else {
                    questionContainer.innerHTML = `<p>No questions available.</p>`;
                }
            }

            window.nextQuestion = function() {
                if (currentQuestionIndex < questions.length - 1) {
                    const selectedOption = document.querySelector(`input[name="answer${currentQuestionIndex}"]:checked`);
                    if (selectedOption) {
                        selectedAnswers[currentQuestionIndex] = selectedOption.value;
                    }
                    currentQuestionIndex++;
                    showQuestion();
                }
            }

            window.prevQuestion = function() {
                if (currentQuestionIndex > 0) {
                    const selectedOption = document.querySelector(`input[name="answer${currentQuestionIndex}"]:checked`);
                    if (selectedOption) {
                        selectedAnswers[currentQuestionIndex] = selectedOption.value;
                    }
                    currentQuestionIndex--;
                    showQuestion();
                }
            }

            window.submitQuiz = function() {
                const quizForm = document.getElementById('quizForm');
                const formData = new FormData(quizForm);
                formData.append('answers', JSON.stringify(selectedAnswers));

                fetch(`/quizzes/${formData.get('quiz_id')}/submit`, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        $('#quizModal').modal('hide');
                        clearInterval(timer);
                        alert(`Your score: ${data.score}`);
                    });
            }

            function getAnswers() {
                return selectedAnswers;
            }
        });
    </script>
@endpush
