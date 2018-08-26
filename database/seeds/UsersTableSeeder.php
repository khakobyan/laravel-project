<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\{
    User,
    Post,
    PostComment,
    Product,
    ProductComment
};

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws Exception
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            factory(User::class, 10)->create()->each(function ($user) {
                $posts = factory(Post::class, rand(1, 5))->make();
                $user->posts()->saveMany($posts);
                $postComments = factory(PostComment::class, rand(1, 4))->make();
                $user->comments()->saveMany($postComments);
                $products = factory(Product::class, rand(1, 3))->make();
                $user->products()->saveMany($products);
                $productComments = factory(ProductComment::class, rand(1, 4))->make();
                $user->comments()->saveMany($productComments);
            });
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw (new Exception("Error in User Seed"));
        }
    }
}
