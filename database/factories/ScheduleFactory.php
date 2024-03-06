<?php

namespace Database\Factories;

use App\Models\Movie;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $movieIds = Movie::pluck('id')->all();
        $randomMovieId = $this->faker->randomElement($movieIds);

        $startTime = CarbonImmutable::now()->addHours(rand(1, 24))->addMinute(rand(0, 59))->addSecond(rand(0, 59));
        $endTime = $startTime->copy()->addHours(2); 

        return [
            'movie_id' => $randomMovieId,
            'start_time' => $startTime,/* laravelでは、carbonインスタンスを日付として自動的に解釈してDBによしなに保存してくれる */
            'end_time' => $endTime,
        ];
    }
}
