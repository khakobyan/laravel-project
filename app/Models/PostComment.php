<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
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
