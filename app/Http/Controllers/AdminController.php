<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('admin_movies', ['movies' => $movies]);
    }

    public function create()
    {
        return view('admin_movies_create');
    }
    
    public function store(Movie $movie, Genre $genre, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|unique:movies',
            'genre' => 'required|string',
            'image_url' => 'required|url',
            'published_year' => 'required|numeric',
            'description' => 'required|string',
            'is_showing' => 'sometimes|required',
        ]);

        DB::transaction(function() use ($request, $genre, $movie) {
            //ジャンルの存在確認 firstを使うことで、getによるコレクションではなく、レコード1つを配列でもらえる
            $genre_data = Genre::where('name', $request->genre)->first();

            if(is_null($genre_data)){
                //ジャンルの保存
                $genre->fill(['name' => $request->genre])->save();
                $genre_data = $genre;
            }

            //データの整形
            $requestData = $request->except('genre');
            $requestData['genre_id'] = $genre_data->id;

            //映画の保存
            $movie->fill($requestData)->save();
        });

        return redirect('/admin/movies')->with('status', '映画が正常に登録されました');
    }

    public function edit($id)//暗黙の結合使わないバージョン
    {
        $movie = Movie::find($id);

        if (!$movie) {
            abort(500, '編集しようとした映画は存在しません');
        }

        return view('admin_movies_edit')->with('selected_movie', $movie)->with('genre_name', $movie->genre->name);
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string|unique:movies',
            'genre' => 'required|string',
            'image_url' => 'required|url',
            'published_year' => 'required|numeric',
            'description' => 'required|string',
            'is_showing' => 'sometimes|required',
        ]);

        //movieの存在確認
        $movie = Movie::find($id);
        if (!$movie) {
            abort(500, '指定された映画が見つかりませんでした');
        }

        DB::transaction(function() use ($request, $movie) {
            // ジャンルの取得または新規作成
            $genre_data = Genre::firstOrCreate(['name' => $request->genre]);

            // レコードが見つからなかったときのnullチェック
            if ($genre_data === null) {
                abort(500, 'ジャンルの取得または作成に失敗しました');
            }

            // 映画の更新
            $movie->update($request->all());
            $movie->genre_id = $genre_data->id;
            $movie->save();
        });

        return redirect('/admin/movies')->with('status', '映画が正常に編集されました。');
    }

    public function delete($id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            return response('指定された映画は存在しません。', 404);
        }

        $movie->delete();

        return redirect('/admin/movies')->with('success', '映画が正常に削除されました。');
    }

    public function detail($id, Movie $movie)
    {
        $movie = Movie::find($id);

        return view('admin_movies_detail', ['movie' => $movie]);
    }

}
