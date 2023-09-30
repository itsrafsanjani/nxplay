<?php

namespace App\Models;

use App\Events\VideoCreated;
use App\Events\VideoDeleted;
use App\Events\VideoUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Video extends Model
{
    use HasFactory;

    protected $appends = [
        'poster_url',
        'photo_urls',
    ];

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
        'tmdb_id',
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

        static::creating(function ($video) {
            $video->slug = Str::slug($video->title . '-' . $video->year);
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
        return (bool)$user->videoLikes()
            ->where('video_id', $this->id)
            ->where('status', 1)
            ->count();
    }

    public function isDislikedBy(User $user)
    {
        return (bool)$user->videoLikes()
            ->where('video_id', $this->id)
            ->whereNotNull('status')
            ->where('status', 0)
            ->count();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * The event map for the model.
     *
     * Allows for object-based events for native Eloquent events.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => VideoCreated::class,
        'updated' => VideoUpdated::class,
        'deleted' => VideoDeleted::class,
    ];

    public function getPosterUrlAttribute()
    {
        return '//image.tmdb.org/t/p/w500' . $this->poster;
    }

    public function getPhotoUrlsAttribute()
    {
        if (!$this->photos) {
            return [];
        }

        $photos = json_decode($this->photos);

        $photoUrls = [];

        foreach ($photos as $photo) {
            $photoUrls[] = '//image.tmdb.org/t/p/w500' . $photo;
        }

        return $photoUrls;
    }
}
