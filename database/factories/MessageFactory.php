<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker, $atts) {

    echo 'M';

    $date = $faker->dateTimeBetween('- 30 days', 'now');

    return [
        'from_user_id' => $atts['from_user_id'],
        'content' => $faker->realText,
        'created_at' => $date,
        'updated_at' => $date
    ];
});
