<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'video_id',
        'comment_text',
        'parent_id',
        'replied_to_id'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot() {
        parent::boot();

        static::deleting(function($comment) {
            $comment->replies()->get('id')->each->delete();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function commentLikes()
    {
        return $this->hasMany(CommentLike::class)->where('status', 1);
    }

    public function commentDislikes()
    {
        return $this->hasMany(CommentLike::class)->where('status', 0);
    }

    public function isLikedBy(User $user): bool
    {
        return (bool) $user->commentLikes
            ->where('comment_id', $this->id)
            ->where('status', 1)
            ->count();
    }

    public function isDislikedBy(User $user): bool
    {
        return (bool) $user->commentDislikes
            ->where('comment_id', $this->id)
            ->whereNotNull('status')
            ->where('status', 0)
            ->count();
    }
}
