<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'text',
        'image',
        'user_id',
        'category_id',
        'related_data'
    ];
}
