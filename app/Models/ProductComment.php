<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cog\Contracts\Love\Likeable\Models\Likeable as LikeableContract;
use Cog\Laravel\Love\Likeable\Models\Traits\Likeable;

class ProductComment extends Model implements LikeableContract
{
    use Likeable;

    protected $table = 'product_comments';

    public static $relationships = [
        'user',
        'product'
    ];

    protected $fillable = [
        'text',
        'image',
        'user_id',
        'product_id',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function product() { return $this->belongsTo(Product::class); }
}
