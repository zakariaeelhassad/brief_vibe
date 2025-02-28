<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = ['name' , 'email' , 'password' , 'profile_picture',];


    public function followers()
    {
        return $this->hasMany(Follow::class, 'following_id')->where('status', 'accepted');
    }

    public function following()
    {
        return $this->hasMany(Follow::class, 'follower_id')->where('status', 'accepted');
    }

    public function pendingFollowers()
    {
        return $this->hasMany(Follow::class, 'following_id')->where('status', 'pending');
    }

    public function friends()
    {
        return $this->hasMany(Follow::class, 'follower_id')
            ->where('status', 'accepted')
            ->with('following')
            ->union(
                $this->hasMany(Follow::class, 'following_id')
                    ->where('status', 'accepted')
                    ->with('follower')
            );
    }

    public function friend()
    {
        $friends1 = $this->hasMany(Follow::class, 'follower_id')
            ->where('status', 'accepted')
            ->pluck('following_id');

        $friends2 = $this->hasMany(Follow::class, 'following_id')
            ->where('status', 'accepted')
            ->pluck('follower_id');

        return $friends1->merge($friends2);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function isFollowing($userId)
    {
        return Follow::where('follower_id', $this->id)
                    ->where('following_id', $userId)
                    ->where('status', 'accepted')
                    ->exists();
    }






}
