<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Video extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'runtime',
        'year',
        'imdb_id',
        'imdb_rating',
        'genres',
        'country',
        'directors',
        'actors',
        'box_office',
        'poster',
        'video',
        'type',
        'photos',
        'age_rating',
        'status',
    ];

    /*
     * Create slug automatically when video title given
     */

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($video){
            $video->slug = Str::slug($video->title.'-'.$video->year);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
