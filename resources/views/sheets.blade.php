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

                <td>{{ $sheet->row }}-{{ $sheet->column }}</td>

                @if( ($sheet->id % $num_of_column) === 0)
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
</body>
</html>