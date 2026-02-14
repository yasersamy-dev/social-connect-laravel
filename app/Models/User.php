<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable ,  HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts()
{
    return $this->hasMany(Post::class);
}

public function comments()
{
    return $this->hasMany(Comment::class);
}

public function likes()
{
    return $this->hasMany(Like::class);
}


public function sentRequests()
{
    return $this->hasMany(FriendRequest::class, 'sender_id');
}

public function receivedRequests()
{
    return $this->hasMany(FriendRequest::class, 'receiver_id');
}

public function friends()
{
    return $this->belongsToMany(
        User::class,
        'friend_requests',
        'sender_id',
        'receiver_id'
    )->wherePivot('status', 'accepted');
}

public function allFriends()
{
    return User::whereHas('sentRequests', function ($q) {
        $q->where('receiver_id', $this->id)
          ->where('status', 'accepted');
    })
    ->orWhereHas('receivedRequests', function ($q) {
        $q->where('sender_id', $this->id)
          ->where('status', 'accepted');
    });
}


}
