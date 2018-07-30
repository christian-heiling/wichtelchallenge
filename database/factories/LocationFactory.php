<?php

use Faker\Generator as Faker;

$factory->define(App\Location::class, function (Faker $faker, $atts) {

    $zips = [];
    for($i = 1; $i <= 23; $i++) {
        if ($i < 10) {
            $zips[] = '10' . $i . '0';
        } else {
            $zips[] = '1' . $i . '0';
        }
    }

    echo 'L';
    return [
        'institution_id' => $atts['institution_id'],
        'name' => $faker->company,
        'street' => $faker->streetAddress,
        'zip' => $faker->randomElement($zips),
        'city' => 'Wien',
        'open_on_public_holidays' => $faker->boolean(30)
    ];
});
