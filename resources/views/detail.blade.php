<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies</title>
</head>
<body>
    <h1>映画詳細画面</h1>

    <div class="movieDetailContainer">
        <ul>
            <li>ID: {{ $movie->id }}</li>
            <li>タイトル: {{ $movie->title }}</li>
            <li>ジャンル: {{ $movie->genre->name }}</li>
            <li><img src="{{ $movie->image_url }}" alt="movie image"></li>
            <li>公開年: {{ $movie->published_year }}</li>
            <li>上映中かどうか: 
                @if ($movie->is_showing === 1)
                    上映中
                @else
                    公開予定
                @endif
            </li>
            <li>概要: {{ $movie->description }}</li>
            <li>created_at: {{ $movie->created_at->format('H:i') }}</li>
            <li>updated_at: {{ $movie->updated_at->format('H:i') }}</li>

        </ul>

        <h3>上映スケジュール</h3>
        <div class="movieSchedule">
            <ul>
                @foreach ($schedules as $schedule)
                    <li>[時刻] 開始時刻 : {{ $schedule->start_time->format('H:i') }}, 終了時刻 : {{ $schedule->end_time->format('H:i') }}</li>
                @endforeach
            </ul>
        </div>

    </div>

</body>
</html>