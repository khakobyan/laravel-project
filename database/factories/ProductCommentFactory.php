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

$factory->define(App\Models\ProductComment::class, function (Faker $faker) {
    $productIds = App\Models\Product::all()->pluck('id')->toArray();
    return [
        'text' => 'comment text',
        'product_id' => $faker->randomElement($productIds)
    ];
});
