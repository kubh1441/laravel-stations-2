<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Sheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ReservationController extends Controller
{
    public function sheets($movie_id, $schedule_id, Sheet $sheets, Request $request)
    {
        $date = $request->query('date');

        if(!$date){
            abort(400, 'Bad Request');
        }

        $carbonDate = Carbon::parse($date);

        $sheets = Sheet::all();
        
        $reserved_sheet_Ids = Reservation::where('schedule_id', $schedule_id)->pluck('sheet_id');

        return view('sheets_reservable', ['sheets' => $sheets, 'num_of_column' => $sheets->max('column'), 'movie_id' => $movie_id, 'schedule_id' => $schedule_id, 'date' => $carbonDate, 'reserved_sheet_Ids' => $reserved_sheet_Ids]);
    }

    public function create ($movie_id, $schedule_id, Request $request)
    {
        $requestDate = $request->query('date');
        $requestSheetId = $request->query('sheetId');

        $reservation = Reservation::where('date', $requestDate)->orWhere('sheet_id', $requestSheetId)->first();

        if($reservation){
            abort(400, 'Bad Request');
        }

        if(!$request->query('date') || !$request->query('sheetId')){
            abort(400, 'Bad Request');
        }

        return view('sheet_reservation', ['movie_id' => $movie_id, 'schedule_id' => $schedule_id, 'date' => $request->query('date'), 'sheet_id' => $request->query('sheetId')]);
    }

    public function store (Request $request, Reservation $reservation)
    {
        //バリデーションチェック
        $validator = Validator::make($request->all(), [
            'date' => 'bail|required|date_format:Y-m-d',
            'schedule_id' => 'bail|required',
            'sheet_id' => 'bail|required',
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc'                
        ]);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        //座席予約の存在チェック
        $reservation = Reservation::where('schedule_id', $request->schedule_id)
                                    ->where('sheet_id', $request->sheet_id)
                                    ->first();

        if (!$reservation) {
            Reservation::create([
                'date' => $request->date,
                'schedule_id' => $request->schedule_id,
                'sheet_id' => $request->sheet_id,
                'name' => $request->name,
                'email' => $request->email,
            ]);
        
        } else {
            if ($reservation->is_canceled) {
                $reservation->update([
                    'date' => $request->date,
                    'name' => $request->name,
                    'email' => $request->email,
                    'is_canceled' => false,
                ]);
            } else {
                return redirect('/movies/' . $request->movie_id . '/schedules/' . $request->schedule_id . '/sheets?date=' . $request->date)
                        ->with('status', '座席が既に予約されています。');
            }
        }

        return redirect('/movies/' . $request->movie_id)->with('status', '予約が完了しました');

    }
}
