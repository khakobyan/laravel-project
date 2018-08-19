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

$factory->define(App\Models\Product::class, function (Faker $faker) {
    $currencies = ['USD', 'EUR', 'AMD', 'RUB', 'CAD', 'CNY', 'JPY'];
    return [
        'title' => $faker->title,
        'description' => 'test description',
        'price' => rand(200, 800),
        'currency' => $faker->randomElement($currencies)
    ];
});
