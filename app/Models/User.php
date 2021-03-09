<?php

namespace App\Models;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, SoftDeletes, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'provider_id',
        'avatar',
        'password',
        'role',
        'fcm_token',
        'last_login_at',
        'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * JWT Token
     */

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function topicPushNotification($to, $title, $body, $video_id, $poster)
    {
        $data['to'] = '/topics/' . $to;
        $data['notification']['title'] = $title;
        $data['notification']['body'] = $body;
        $data['data']['video_id'] = $video_id;
        $data['data']['poster'] = $poster;

        $http = new Client(['headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => 'key=' . config('services.fcm.server_key')
        ]]);
        try {
            $response = $http->post('https://fcm.googleapis.com/fcm/send', [
                'json' => $data
            ]);
            return $response->getBody();
        } catch (GuzzleException $e) {
            return $e;
        }
    }

    public function commentPushNotification($fromUser, $comment, $video)
    {
        $to = $this->fcm_token;

        if (!empty($to)) {
            $data['to'] = $to;
            $data['notification']['title'] = $fromUser->name . ' replied to your comment';
            $data['notification']['body'] = 'on "' . $video->title . '" ' . str_replace('@' . $this->name, "", $comment->comment_text);
            $data['notification']['click_action'] = "FLUTTER_NOTIFICATION_CLICK";
            $data['data']['sound'] = "default";
            $data['data']['status'] = "done";
            $data['data']['screen'] = "/single_video";
            $data['data']['video_id'] = $video->id;
            $data['data']['poster'] = 'https://image.tmdb.org/t/p/w45/' . $video->poster;

            $http = new Client(['headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'key=' . config('services.fcm.server_key')
            ]]);
            try {
                $response = $http->post('https://fcm.googleapis.com/fcm/send', [
                    'json' => $data
                ]);
                return $response->getBody();
            } catch (GuzzleException $e) {
                return $e;
            }
        }

        return 0;
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function videoLikes()
    {
        return $this->hasMany(VideoLike::class);
    }

    public function commentLikes()
    {
        return $this->hasMany(CommentLike::class);
    }

    public function commentDislikes()
    {
        return $this->hasMany(CommentLike::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

}
