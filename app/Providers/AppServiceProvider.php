<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\{
    User,
    Post,
    PostComment,
    Product,
    ProductComment
};
use App\Observers\{
    UserObserver,
    PostObserver,
    PostCommentObserver,
    ProductObserver,
    ProductCommentObserver
};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Post::observe(PostObserver::class);
        PostComment::observe(PostCommentObserver::class);
        Product::observe(ProductObserver::class);
        ProductComment::observe(ProductCommentObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }
}
