<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    public static $relationships = [
        'user',
    ];

    protected $fillable = [
        'text',
        'image',
        'user_id',
        'category_id',
        'related_data'
    ];

    public function user() { return $this->belongsTo(User::class); }
}
