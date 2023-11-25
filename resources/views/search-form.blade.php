<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search Form</title>
    <link href="/bootstrap-5.3.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/icons/quiz.png">
</head>

<body>
    <div class="search-form vh-100 d-flex justify-content-center align-items-center">
        <form class="form-group p-2 border rounded" onsubmit="submitForm()" action="{{ route('trivia-questions.process') }}" method="post">

            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- 1. Full name --}}
            <div class="col p-1">
                <label for="fullNameInput">Full name</label>
                <input class="form-control" type="text" name="full_name" id="fullNameInput" placeholder="Enter full name" required>
            </div>

            {{-- 2. Email address --}}
            <div class="col p-1">
                <label for="emailAddressInput">Email address</label>
                <input class="form-control" type="email" name="email_address" id="emailAddressInput" aria-describedby="emailHelp" placeholder="Enter email" required>
            </div>

            {{-- 3. Number of questions --}}
            <div class="col p-1">
                <label for="questionsAmountInput">Number of questions</label>
                <input class="form-control" type="number" name="questions_amount" id="questionsAmountInput" min="1" max="50" value="1">
                <small class="form-text text-muted">Note: Questions from the category "Entertainment: Video Games"<br>will be excluded from the amount.</small>
            </div>
            

            {{-- 4. Select difficulty  --}}
            <div class="col p-1">
                <label for="selectDifficultyInput">Select difficulty</label>
                <select class="form-control" name="select_difficulty" id="selectDifficultyInput">
                    <option value="any">Any difficulty</option>
                    <option value="easy">Easy</option>
                    <option value="medium">Medium</option>
                    <option value="hard">Hard</option>
                </select>
            </div>

            {{-- 5. Select type  --}}
            <div class="col p-1">
                <label for="selectTypeInput">Select type</label>
                <select class="form-control" name="select_type" id="selectTypeInput">
                    <option value="any">Any Type</option>
                    <option value="multiple">Multiple Choice</option>
                    <option value="boolean">True / False</option>
                </select>
            </div>

            {{-- Submit button  --}}
            <div class="col p-1">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <script src="/bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script>
        function submitForm() {
            var selectDifficulty = document.getElementById('selectDifficultyInput');
            var selectType = document.getElementById('selectTypeInput');
            var optionsDifficulty = selectDifficulty.options;
            var optionsType = selectType.options;

            if (selectDifficulty.value === 'any') {
                var randomIndexDifficulty;
                do {
                    randomIndexDifficulty = Math.floor(Math.random() * optionsDifficulty.length);
                } while (optionsDifficulty[randomIndexDifficulty].value === 'any');

                selectDifficulty.selectedIndex = randomIndexDifficulty;
            }

            if (selectType.value === 'any') {
                var randomIndexType;
                do {
                    randomIndexType = Math.floor(Math.random() * optionsType.length);
                } while (optionsType[randomIndexType].value === 'any');

                selectType.selectedIndex = randomIndexType;
            }
            document.querySelector('form').submit();
        }
    </script>
</body>

</html>
