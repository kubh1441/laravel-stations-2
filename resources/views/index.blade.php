<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies</title>
</head>
<body>
    <h1>映画リスト</h1>

    <form action="/movies" method="GET">
        @csrf <!-- @csrfいるかな？ -->
        <div class="radio-container">
            <input type="radio" id="all" name="is_showing" value="" checked>
            <label for="all">すべて</label>
            <input type="radio" id="published" name="is_showing" value="1">
            <label for="scheduled">公開中</label>
            <input type="radio" id="scheduled" name="is_showing" value="0">
            <label for="scheduled">公開予定</label>
        </div>

        <input type="text" name="keyword" placeholder="キーワード">
        <button type="submit">検索する</button>
    </form>

    <div class="moviesContainer">
        <ul>
        @foreach ($movies as $movie)
            <li>ID: {{ $movie->id }}</li>
            <li>タイトル: {{ $movie->title }}</li>
            <li>画像URL: {{ $movie->image_url }}</li>
            <li>created_at: {{ $movie->created_at }}</li>
            <li>updated_at: {{ $movie->updated_at }}</li>
            <br>
        @endforeach
        </ul>
    </div>

    {{ $movies->links() }}

</body>
</html>