<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Schedule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class ScheduleController extends Controller
{
    public function index (Movie $movies)
    {
        $movies = Movie::with('schedules')->get();

        return view('admin_schedules', ['movies' => $movies]);
    }

    public function detail ($id, Schedule $schedule) 
    {
        $schedule  = Schedule::find($id);

        return view('admin_schedules_detail', ['schedule' => $schedule]);
    }

    public function create ($id)
    {
        return view('admin_schedules_create', ['movie_id' => $id]);
    }

    public function store ($id, Request $request, Schedule $schedule)
    {
        /* テストケースを見てそれ通るようにしてみた->そのテストケースが期待するのはエラーだった
        if(Str::contains($request->start_time_time, '時') || Str::contains($request->start_time_time, '分')){
            $start_time_time = Str::replace('時', ':', $request->start_time_time);
            $start_time_time = Str::replace('分', '', $start_time_time);
        }else{
            $start_time_time = $request->start_time_time;
        }
        
        if(Str::contains($request->end_time_time, '時') || Str::contains($request->end_time_time, '分')){
            $end_time_time = Str::replace('時', ':', $request->end_time_time);
            $end_time_time = Str::replace('分', '', $end_time_time);
        }else{
            $end_time_time = $request->end_time_time;
        }

        $request->merge([
            'start_time_time' => $start_time_time,
            'end_time_time' => $end_time_time,
        ]);
        */

        /* こんなことしなくても、バリデーションがエラーを返してくれる
        $startDateTime = Carbon::createFromFormat('Y/m/d H:i', $request->start_time_date . ' ' . $request->start_time_time);
        $endDateTime = Carbon::createFromFormat('Y/m/d H:i', $request->end_time_date . ' ' . $request->end_time_time);

        // Carbonがnullを返す場合は、日時文字列が正しくないことを意味する
        if (!$startDateTime || !$endDateTime) {
           $validator = Validator::make([], []); // 空のバリデーターを作成
            $validator->errors()->add('invalid_datetime', '日時のフォーマットが正しくありません');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        */
        
        /* 日付フォーマットに合わせたバリデーションルールを追加するべき
        $validator = Validator::make($request->all(), [
            'movie_id' => 'required',
            'start_time_date' => 'required|string',
            'end_time_date' => 'required|string',
            'start_time_time' => 'required|string',
            'end_time_time' => 'required|string',
        ]);
        */

        $validator = Validator::make($request->all(), [
            'movie_id' => 'required',
            'start_time_date' => 'required|date_format:Y-m-d',
            'end_time_date' => 'required|date_format:Y-m-d',
            'start_time_time' => 'required|date_format:H:i',
            'end_time_time' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $startDateTimeString = $request->start_time_date . ' ' . $request->start_time_time;
        $endDateTimeString = $request->end_time_date . ' ' . $request->end_time_time;
        
        $schedule->fill([
            'movie_id' => $id,
            'start_time' => $startDateTimeString,
            'end_time' => $endDateTimeString,
        ])->save();
        
        $newScheduleId = $schedule->id; //saveメソッドを呼び出した後の$scheduleオブジェクトは、DBに保存された後のモデルになるため、そのままidを取り出せる。

        return redirect('/admin/schedules/' . $newScheduleId)->with('status', 'スケジュールが正常に登録されました');
    }

    public function edit ($scheduleId)
    {
        $schedule = Schedule::find($scheduleId);

        //ビューファイルにCarbonインスタンスを渡すときは、bladeエンジンが勝手にテキストに変換してくれる。
        return view('admin_schedules_edit', ['schedule' => $schedule]);
    }

    public function update ($id, Request $request, Schedule $schedule)
    {
        $validator = Validator::make($request->all(), [
            'movie_id' => 'required',
            'start_time_date' => 'required|date_format:Y-m-d',
            'end_time_date' => 'required|date_format:Y-m-d',
            'start_time_time' => 'required|date_format:H:i',
            'end_time_time' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $schedule = Schedule::find($id);
        if(!$schedule){
            abort(500, '該当するスケジュールが存在しません');
        }

        $startTime = $request->start_time_date . ' ' . $request->start_time_time;
        $endTime = $request->end_time_date . ' ' . $request->end_time_time;

        $schedule->update([
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);

        return redirect('/admin/schedules/' . $id)->with('status', 'スケジュールが正常に更新されました');
    }

    public function delete ($id, Schedule $schedule) 
    {
        $schedule = Schedule::find($id);
        if(!$schedule){
            return response('指定された映画が存在しません', 404);
        }

        $movie_id = $schedule->movie_id;//先にmovie_idだけ取り出す

        $schedule->delete();

        return redirect('/admin/movies/' . $movie_id)->with('success', 'スケジュールが正常に削除されました。');
    }
}
