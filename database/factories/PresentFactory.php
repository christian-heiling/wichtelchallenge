<?php

use Faker\Generator as Faker;

$factory->define(App\Present::class, function (Faker $faker, $atts) {

    echo 'P';

    return [
        'from_user_id' => $atts['from_user_id'],
        'wish_id' => $atts['wish_id'],
        'state' => $faker->randomElement(App\Present::getAvailableStates()),
        'due_date' => $faker->dateTimeBetween('- 30 days', '+ 30 days'),
        'amount' => $faker->numberBetween(1, 3)
    ];
});
