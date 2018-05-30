<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function ($faker) {
    return [
        'name' => $name = $faker->firstName(),
        'slug' => str_slug($name),
        'description' => $faker->paragraph,
        'stock' => $faker->numberBetween(10,20),
        'price' => $faker->numberBetween(10000,5000000),
        'discount' => $faker->randomElement(array(null,3,4,5,7,8,9)),
        'category_id' => $faker->randomElement(array(2,3,4,5,7,8,9)),
        'brand_id' => $faker->randomElement(array(2,3,4,5,7,8)),
    ];
});
