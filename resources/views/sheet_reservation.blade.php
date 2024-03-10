<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>座席予約</title>
</head>
<body>
    <h1>座席予約 登録画面</h1>

    <div id="formContainer">
        <form action="/reservations/store" method="POST">
            @csrf

            <div>
                <label for="movie_id">映画作品: </label>
                <span>{{ $movie_id }}</span>
                <input type="hidden" id="movie_id" name="movie_id" value="{{ $movie_id }}">
            </div>
            <div>
                <label for="schedule_id">上映スケジュール: </label>
                <span>{{ $schedule_id }}</span>
                <input type="hidden" id="schedule_id" name="schedule_id" value="{{ $schedule_id }}">
            </div>
            <div>
                <label for="date">日付: </label>
                <span>{{ $date }}</span>
                <input type="hidden" id="date" name="date" value="{{ $date }}">
            </div>
            <div>
                <label for="sheet_id">座席: </label>
                <span>{{ $sheet_id }}</span>
                <input type="hidden" id="sheet_id" name="sheet_id" value="{{ $sheet_id }}">
            </div>            
            <div>
                <label for="name">予約者氏名: </label>
                <input type="text" id="name" name="name">
            </div>
            <div>
                <label for="email">予約者メールアドレス: </label>
                <input type="email" id="email" name="email">
            </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <input type="submit" value="送信する">
        </form>

    </div>

</body>
</html>