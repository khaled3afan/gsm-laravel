<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Service;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'description' => $faker->sentence(10),
        'content'    => $faker->text(200),
        'category_id' => 1,
        'servicetype_id' => $faker->numberBetween(1,2),
        'price'  => $faker->randomFloat(3, 0, 20),
        'real_price' => $faker->randomFloat(3, 0, 29),
        'image' => 'servicesimages/gm6mRSXzQt80ezT3oRopKqFLKGacvsNuILJWsn1B.jpeg'
         
    ];
});
