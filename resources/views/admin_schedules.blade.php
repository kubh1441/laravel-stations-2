<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Movies Schedules</title>
</head>
<body>
    <h1>管理画面 スケジュール 一覧</h1>

    @if (session('status'))
        <div class="alert alert-msg">
            {{ session('status') }}
        </div>
    @endif

    @foreach ($movies as $movie)
        @if (!$movie->schedules->isEmpty())
            <h2>作品ID: {{ $movie->id }}  作品名: {{ $movie->title }}</h2>
            @foreach ($movie->schedules as $schedule)
                <p><a href="/admin/schedules/{{$schedule->id}}">{{ $schedule->start_time }} / {{ $schedule->end_time }}</a> [created at {{ $schedule->created_at }} / updated at {{ $schedule->updated_at }}]</p>
            @endforeach
        @endif
    @endforeach

</body>
</html>