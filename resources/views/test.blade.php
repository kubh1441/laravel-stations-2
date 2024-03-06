<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies</title>
</head>
<body>
    <h1>テストページ</h1>

    <p>movie->title : {{ $movie->title }}</p>

    @foreach ($movie->schedules as $schedule)
        <p>schedule->id: {{ $schedule->id }}</p>
        <p>schedule->start_time: {{ $schedule->start_time->format('H:i') }}</p>
        <p>schedule->end_time: {{ $schedule->end_time->format('H:i') }}</p>
        <br>
    @endforeach

</body>
</html>