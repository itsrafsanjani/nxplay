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
        'likes',
        'dislikes',
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

    public function comments()
    {
        return $this->hasMany(Comment::class)
            ->latest()
            ->whereNull('parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class)
            ->latest()
            ->where('parent_id');
    }

    public function videoLikes()
    {
        return $this->hasMany(VideoLike::class)->where('status', 1);
    }

    public function videoDislikes()
    {
        return $this->hasMany(VideoLike::class)->where('status', 0);
    }

    public function isLikedBy(User $user)
    {
        return (bool) $user->videoLikes()
            ->where('video_id', $this->id)
            ->where('status', 1)
            ->count();
    }

    public function isDislikedBy(User $user)
    {
        return (bool) $user->videoLikes()
            ->where('video_id', $this->id)
            ->whereNotNull('status')
            ->where('status', 0)
            ->count();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
