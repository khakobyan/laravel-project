<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cog\Contracts\Love\Liker\Models\Liker as LikerContract;
use Cog\Laravel\Love\Liker\Models\Traits\Liker;
use Hootlex\Friendships\Traits\Friendable;

class User extends Authenticatable implements LikerContract
{
    use Notifiable, HasApiTokens, SoftDeletes, Liker, Friendable;

    protected $dates = ['deleted_at'];

    protected $relationships = [
        'posts',
        'comments'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name', 
        'email', 
        'password', 
        'active', 
        'activation_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'activation_token',
    ];

    public function posts() { return $this->hasMany(Post::class); }
    public function comments() { return $this->hasMany(PostComment::class); }

}
