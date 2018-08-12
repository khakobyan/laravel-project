<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cog\Contracts\Love\Likeable\Models\Likeable as LikeableContract;
use Cog\Laravel\Love\Likeable\Models\Traits\Likeable;

class Post extends Model implements LikeableContract
{
    use Likeable;
    
    protected $table = 'posts';

    public static $relationships = [
        'user',
        'comments'
    ];

    protected $fillable = [
        'text',
        'image',
        'user_id',
        'category_id',
        'related_data'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function comments() { return $this->hasMany(PostComment::class); }

    public function getReactionsCount()
    {
        return $this->likesCount;
    }
}
