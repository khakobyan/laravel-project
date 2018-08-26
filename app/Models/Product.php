<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cog\Contracts\Love\Likeable\Models\Likeable as LikeableContract;
use Cog\Laravel\Love\Likeable\Models\Traits\Likeable;


class Product extends Model implements LikeableContract
{
    use Likeable;

    protected $table = 'products';

    public static $relationships = [
        'user',
        'comments',
    ];

    protected $appends = [
        'reaction_counts',
        // 'reacted_users',
    ];

    protected $fillable = [
        'title',
        'image',
        'user_id',
        'description',
        'related_data',
        'price',
        'currency',
        'type',
        'subtype',
        'active',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function comments() { return $this->hasMany(ProductComment::class); }

    public function getReactedUsersAttribute()
    {
        $users = [
            'liked_users' => $this->likes,
            'disliked_users' => $this->dislikes,
        ];

        return $users;
    }

    public function getReactionCountsAttribute()
    {
        $counts = [
            'likes' => $this->likesCount,
            'dislikes' => $this->dislikesCount, 
        ];
        
        return $counts;
    }
}
