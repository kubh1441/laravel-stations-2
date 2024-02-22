<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Movies Edit</title>
</head>
<body>
    <h1>映画 編集画面</h1>

    <div id="formContainer">
        <form action="/admin/movies/{{ $selected_movie->id }}/update" method="POST">
        @method('patch')
        @csrf

            <div>
                <label for="title">映画タイトル</label>
                <input type="text" id="title" name="title" value="{{$selected_movie->title}}">
            </div>
            <div>
                <label for="genre">ジャンル</label>
                <input type="text" id="genre" name="genre" value="{{$genre_name}}">
            </div>
            <div>
                <label for="image_url">画像URL</label>
                <input type="text" id="image_url" name="image_url" value="{{$selected_movie->image_url}}">
            </div>
            <div>
                <label for="published_year">公開年</label>
                <input type="number" id="published_year" name="published_year" min="1900" max="2024" value="{{$selected_movie->published_year}}">
            </div>
            <div>
                <label for="is_showing">上映中がどうか</label>
                <input type="checkbox" id="is_showing" name="is_showing" value="1" {{ $selected_movie->is_showing ? 'checked' : ''}}>
            </div>
            <div>
                <label for="description">概要</label>
                <textarea name="description" id="description" cols="30" rows="10">{{$selected_movie->description}}</textarea>
            </div>

            <!-- Laravelでは、バリデーションに失敗した時、そのエラーメッセージを付与してこのページに自動でリダイレクトしてくれる！スゲェ。 -->
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <input type="submit" value="反映する">
        </form>

    </div>

</body>
</html>