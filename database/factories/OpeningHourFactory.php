<?php

use Faker\Generator as Faker;

$factory->define(App\OpeningHour::class, function (Faker $faker, $atts) {

    echo 'O';

    return [
        'location_id' => $atts['location_id'],
        'weekday' => $faker->numberBetween(0, 6),
        'from' => $faker->time(),
        'to' => $faker->time()
    ];
});