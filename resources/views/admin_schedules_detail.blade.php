<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Movies Schedules</title>
</head>
<body>
    <h1>スケジュール 詳細</h1>

    <ul>
        <li>ID: {{ $schedule->id }}</li>
        <li>movie ID: {{ $schedule->movie_id }}</li>
        <li>start time: {{ $schedule->start_time }}</li>
        <li>end time: {{ $schedule->end_time }}</li>
        <li>created at: {{ $schedule->created_at }}</li>
        <li>updated at: {{ $schedule->updated_at }}</li>
    </ul>

</body>
</html>