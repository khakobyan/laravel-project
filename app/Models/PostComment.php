<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cog\Contracts\Love\Likeable\Models\Likeable as LikeableContract;
use Cog\Laravel\Love\Likeable\Models\Traits\Likeable;

class PostComment extends Model implements LikeableContract
{
    use Likeable;

    protected $table = 'post_comments';

    public static $relationships = [
        'user',
        'post'
    ];

    protected $fillable = [
        'text',
        'image',
        'user_id',
        'post_id',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function post() { return $this->belongsTo(Post::class); }
}
