<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Movies Create</title>
</head>
<body>
    <h1>映画スケジュール 登録画面</h1>

    <div id="formContainer">
        <form action="/admin/movies/{{ $movie_id }}/schedules/store" method="post">
            @csrf

            <div>
                <label for="movie_id">映画ID: </label>
                <span>{{ $movie_id }}</span>
                <input type="hidden" id="movie_id" name="movie_id" value="{{ $movie_id }}">
            </div>
            <div>
                <label for="start_time_date">開始日付: </label>
                <input type="date" id="start_time_date" name="start_time_date">
            </div>
            <div>
                <label for="end_time_date">終了日付: </label>
                <input type="date" id="end_time_date" name="end_time_date">
            </div>            
            <div>
                <label for="start_time_time">開始時刻: </label>
                <input type="text" id="start_time_time" name="start_time_time">
            </div>
            <div>
                <label for="end_time_time">終了時刻: </label>
                <input type="text" id="end_time_time" name="end_time_time">
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