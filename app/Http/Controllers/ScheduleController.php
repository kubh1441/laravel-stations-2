<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Schedule;

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
        $this->validate($request, [
            'movie_id' => 'required',
            'start_time_date' => 'required|string',
            'end_time_date' => 'required|string',
            'start_time_time' => 'required|string',
            'end_time_time' => 'required|string',
        ]);

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
        $this->validate($request, [
            'movie_id' => 'required',
            'start_time_date' => 'required|string',
            'end_time_date' => 'required|string',
            'start_time_time' => 'required|string',
            'end_time_time' => 'required|string',
        ]);

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
