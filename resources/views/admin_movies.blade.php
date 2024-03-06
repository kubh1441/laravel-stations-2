<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Movies List</title>
</head>
<body>
    <h1>管理画面 映画リスト テーブル表示</h1>

    <!-- storeエンドポイントからの遷移の時は、映画登録の成功メッセージを表示する。-->
    @if (session('status'))
        <div class="alert alert-msg">
            {{ session('status') }}
        </div>
    @endif

    <table border="1">
        <tr>
            <th>ID</th>
            <th>タイトル</th>
            <th>画像URL</th>
            <th>公開年</th>
            <th>上映中かどうか</th>
            <th>概要</th>
            <th>作成日</th>
            <th>更新日</th>
            <th>詳細</th>
            <th>編集</th>
            <th>削除</th>
        </tr>
        @foreach ($movies as $movie)
            <tr align="center">
                <td>{{ $movie->id }}</td>
                <td>{{ $movie->title }}</td>
                <td>{{ $movie->image_url }}</td>
                <td>{{ $movie->published_year }}</td>
                <td>
                    @if ($movie->is_showing)
                        上映中
                    @else
                        上映予定
                    @endif
                </td>
                <td>{{ $movie->description }}</td>
                <td>{{ $movie->created_at }}</td>
                <td>{{ $movie->updated_at }}</td>
                <td><a href="/admin/movies/{{$movie->id}}"><button>detail</button></a></td>
                <td class="edit-button">
                    <form action="/admin/movies/{{ $movie->id }}/edit" method="get">
                        @csrf
                        <button>edit</button>
                    </form>
                </td>
                <td>
                    <form action="/admin/movies/{{ $movie->id }}/destroy" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('本当に削除しますか？')">delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>