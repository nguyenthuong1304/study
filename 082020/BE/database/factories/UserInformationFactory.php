<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\UserInformation::class, function (Faker $faker) {
    return [
        'price' => rand(200, 1000),
        'address' => $faker->address,
        'bio' => $faker->text,
        'nickname' => 'Chú gấu dễ thương',
        'avatar' => 'https://miro.medium.com/max/1200/1*mk1-6aYaf_Bes1E3Imhc0A.jpeg',
    ];
});
