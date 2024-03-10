<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies</title>
</head>
<body>
    <h1>座席表</h1>

    @if (session('status'))
        <div class="alert alert-msg">
            {{ session('status') }}
        </div>
    @endif

    <div class="sheetMapContainer">
        <table border="1">
            <tr>
                <th>---------</th>
                <th>---------</th>
                <th>スクリーン</th>
                <th>---------</th>
                <th>---------</th>
            </tr>

            @foreach ($sheets as $sheet)
                @if( ($sheet->id % $num_of_column) === 1)
                    <tr align="center">
                @endif

                <td><a href="/movies/{{$movie_id}}/schedules/{{$schedule_id}}/reservations/create?date={{ $date->format('Y-m-d') }}&sheetId={{ $sheet->id }}">{{ $sheet->row }}-{{ $sheet->column }}</a></td>

                @if( ($sheet->id % $num_of_column) === 0)
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
</body>
</html>