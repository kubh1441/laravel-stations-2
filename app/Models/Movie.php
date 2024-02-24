<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Genre;
use App\Models\Schedule;

class Movie extends Model
{
    use HasFactory;

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    protected $fillable = [
        'title',
        "genre_id",
        'image_url',
        'published_year',
        'is_showing',
        'description'
    ];

    public function filterByParameters($is_showing, $keyword, int $limit_count = 20)
    {
        $query = Movie::query();

        if ($is_showing !== null) {
            $query->where('is_showing', $is_showing);
        }
    
        if ($keyword !== null) {
            $query->where(function ($query) use ($keyword) {
                $query
                ->where('title', 'like', "%$keyword%")
                ->orWhere('description', 'like', "%$keyword%");
            });
        }
    
        return $query->paginate($limit_count);
    }
}
