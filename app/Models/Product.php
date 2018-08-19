<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cog\Contracts\Love\Likeable\Models\Likeable as LikeableContract;
use Cog\Laravel\Love\Likeable\Models\Traits\Likeable;


class Product extends Model
{
    use Likeable;

    protected $table = 'products';

    public static $relationships = [
        'user',
        'comments'
    ];

    protected $fillable = [
        'title',
        'image',
        'user_id',
        'description',
        'related_data',
        'price',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function comments() { return $this->hasMany(ProductComment::class); }

    public function getReactionsCount()
    {
        return $this->likesCount;
    }
}
