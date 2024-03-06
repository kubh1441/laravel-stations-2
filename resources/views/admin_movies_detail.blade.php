<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies</title>
</head>
<body>
    <h1>管理画面 映画 詳細</h1>

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
                    上映予定
                @endif
            </li>
            <li>概要: {{ $movie->description }}</li>
            <li>created_at: {{ $movie->created_at }}</li>
            <li>updated_at: {{ $movie->updated_at }}</li>

        </ul>

        <h3>スケジュール</h3>
    
        @if (session('success'))
            <div class="alert alert-msg">
                {{ session('success') }}
            </div>
        @endif
        
        <a href="/admin/movies/{{ $movie->id }}/schedules/create"><button>スケジュールを新たに作成</button></a>
        
        <div class="movieSchedule">
            <ul>
                @if (!$movie->schedules->isEmpty())
                    @foreach ($movie->schedules as $schedule)
                        <li>
                            <a href="/admin/schedules/{{ $schedule->id }}">スケジュールID: {{ $schedule->id }}</a>
                            <p>start_time: {{ $schedule->start_time }}</p>
                            <p>end_time: {{ $schedule->end_time }}</p>
                            <form action="/admin/schedules/{{ $schedule->id }}/edit" method="get">
                                <button>edit</button>
                            </form>
                            <form action="/admin/schedules/{{ $schedule->id }}/destroy" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" onclick="return confirm('本当に削除しますか？')">delete</button>
                            </form>
                        </li>
                        <br>
                    @endforeach
                @else
                    <p>movie->schedulesコレクションの中身はないみたいです</p>
                @endif
            </ul>
        </div>

    </div>

</body>
</html>