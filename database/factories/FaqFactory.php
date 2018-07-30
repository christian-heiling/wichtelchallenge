<?php

use Faker\Generator as Faker;

$factory->define(App\Faq::class, function (Faker $faker) {

    echo 'F';

    return [
        'question' => ucfirst(implode(' ', $faker->words('5'))) . '?',
        'answer' => array_reduce($faker->paragraphs(), function($carry, $item) {
            return $carry .= '<p>' . $item . '</p>';
        })
    ];
});
