<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\PostComment::class, function (Faker $faker) {
    $postIds = App\Models\Post::all()->pluck('id')->toArray();
    // dd($postIds);
    return [
        'text' => 'comment text',
        'post_id' => $faker->randomElement($postIds)
    ];
});
