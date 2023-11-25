<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trivia Questions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/icons/quiz.png">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .question-container {
            max-width: 600px;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="question-container">
        <h1 class="text-center mb-4">Trivia Questions</h1>

        @if(isset($filteredQuestions['questions']))
        <form id="quizForm" action="javascript:void(0);" onsubmit="submitForm()">
            @csrf
            <input type="hidden" name="currentQuestion" value="0">

            @foreach($filteredQuestions['questions'] as $index => $question)
            <div class="question mb-4" id="question_{{ $index }}" @if($index > 0) style="display: none;" @endif>
                <p class="mb-3">{!! $question['question'] !!}</p>

                <div class="form-check">
                    @if($question['type'] == 'multiple')
                    @foreach($question['incorrect_answers'] as $answer)
                    <input class="form-check-input" type="radio" name="answer_{{ $index }}" id="answer_{{ $index }}_{{ $loop->index }}" value="{{ $answer }}">
                    <label class="form-check-label" for="answer_{{ $index }}_{{ $loop->index }}">
                        {!! $answer !!}
                    </label><br>
                    @endforeach
                    @elseif($question['type'] == 'boolean')
                    <input class="form-check-input" type="radio" name="answer_{{ $index }}" id="answer_{{ $index }}_true" value="True">
                    <label class="form-check-label" for="answer_{{ $index }}_true">
                        True
                    </label><br>
                    <input class="form-check-input" type="radio" name="answer_{{ $index }}" id="answer_{{ $index }}_false" value="False">
                    <label class="form-check-label" for="answer_{{ $index }}_false">
                        False
                    </label><br>
                    @endif
                </div>
            </div>
            @endforeach

            <button type="button" class="btn btn-primary mt-3" onclick="nextQuestion()">Next Question</button>
            <button type="submit" class="btn btn-success mt-3" style="display: none;">Submit Answers</button>
        </form>
        @elseif(isset($filteredQuestions))
        <form id="quizForm" action="javascript:void(0);" onsubmit="submitForm()">
            @csrf
            <input type="hidden" name="currentQuestion" value="0">

            @foreach($filteredQuestions as $index => $question)
            <div class="question mb-4" id="question_{{ $index }}" @if($index > 0) style="display: none;" @endif>
                <p class="mb-3">{!! $question['question'] !!}</p>

                <div class="form-check">
                    @if($question['type'] == 'multiple')
                    @foreach($question['incorrect_answers'] as $answer)
                    <input class="form-check-input" type="radio" name="answer_{{ $index }}" id="answer_{{ $index }}_{{ $loop->index }}" value="{{ $answer }}">
                    <label class="form-check-label" for="answer_{{ $index }}_{{ $loop->index }}">
                        {!! $answer !!}
                    </label><br>
                    @endforeach
                    @elseif($question['type'] == 'boolean')
                    <input class="form-check-input" type="radio" name="answer_{{ $index }}" id="answer_{{ $index }}_true" value="True">
                    <label class="form-check-label" for="answer_{{ $index }}_true">
                        True
                    </label><br>
                    <input class="form-check-input" type="radio" name="answer_{{ $index }}" id="answer_{{ $index }}_false" value="False">
                    <label class="form-check-label" for="answer_{{ $index }}_false">
                        False
                    </label><br>
                    @endif
                </div>
            </div>
            @endforeach

            <button type="button" class="btn btn-primary mt-3" onclick="nextQuestion()">Next Question</button>
            <button type="submit" class="btn btn-success mt-3" style="display: none;">Submit Answers</button>
        </form>
        @else
        <p>No trivia questions available.</p>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var selectedAnswers = [];
    
        function nextQuestion() {
            var currentQuestion = parseInt(document.querySelector('input[name="currentQuestion"]').value);
            var selectedAnswer = document.querySelector('input[name="answer_' + currentQuestion + '"]:checked');
    
            // Check if an answer is selected
            if (!selectedAnswer) {
                alert('Please select an answer before moving to the next question.');
                return;
            }
    
            // Get the question and answer values dynamically
            var question = document.getElementById('question_' + currentQuestion).querySelector('.mb-3').innerHTML;
            var answer = selectedAnswer.value;
    
            // Log the question and answer
            console.log('Question:', question);
            console.log('Selected Answer:', answer);
    
            // Store the selected answer in the array
            selectedAnswers[currentQuestion] = {
                question: question,
                answer: answer
            };
    
            // Update the display for the next question
            document.getElementById('question_' + currentQuestion).style.display = 'none';
    
            var totalQuestions = {{ isset($filteredQuestions['questions']) ? count($filteredQuestions['questions']) : count($filteredQuestions) }};
            if (currentQuestion === totalQuestions - 1) {
                document.querySelector('button[type="button"]').style.display = 'none';
                document.querySelector('button[type="submit"]').style.display = 'block';
            } else {
                document.getElementById('question_' + (currentQuestion + 1)).style.display = 'block';
                document.querySelector('input[name="currentQuestion"]').value = currentQuestion + 1;
            }
        }
    
        function submitForm() {
            // Display the selected answers
            var resultHtml = '<h2>Selected Answers</h2>';
            for (var i = 0; i < selectedAnswers.length; i++) {
                resultHtml += '<p><strong>' + selectedAnswers[i].question + '</strong>: ' + selectedAnswers[i].answer + '</p>';
            }
            document.querySelector('.question-container').innerHTML = resultHtml;
        }
    </script>
</body>
</html>
