<?php

namespace App\Models;

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

    public function pushNotification($title, $body, $click_action, $message)
    {

        $token = $this->fcm_token;


        if ($token == null) return 0;

        $data['notification']['title'] = $title;
        $data['notification']['body'] = $body;
        $data['notification']['sound'] = true;
        $data['priority'] = 'normal';
        $data['data']['click_action'] = $click_action;
        $data['data'] = $message;
        $data['to'] = $token;


        $http = new \GuzzleHttp\Client(['headers' => [
            'Centent-Type' => 'application/json',
            'Authorization' => 'key=' . config('services.fcm.server_key')
        ]]);
        try {
            $response = $http->post('https://fcm.googleapis.com/fcm/send', ['json' =>
                $data
            ]);
            return $response->getBody();
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            // return $e->getCode();
            if ($e->getCode() === 400) {
                return response()->json(['ok' => '0', 'error' => 'Invalid Request.'], $e->getCode());
            } else if ($e->getCode() === 401) {
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }
            return response()->json('Something went wrong on the server.', $e->getCode());
        } catch (GuzzleException $e) {
            return response()->json('Fucked up', $e->getCode());
        }

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
