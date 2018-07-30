<?php

use Faker\Generator as Faker;

$factory->define(App\Wish::class, function (Faker $faker, $atts) {

    $title = function() use ($faker) {
        $presents = [
            'shoes' => [
                'items' => [
                    'Boots',
                    'Arbeitsschuhe',
                    'Stiefeln',
                    'Stiefeletten',
                    'Turnschuhe',
                    'Sneakers',
                    'Ballerinas',
                    'Socken'
                ],
                'sizes' => [
                    '38', '39', '40', '41', '42', '43', '44', '45'
                ]
            ],
            'topClothes' => [
                'items' => [
                    'Hemd',
                    'Hoodie',
                    'Pullover',
                    'Strickjacke',
                    'Mantel',
                    'T-Shirt',
                    'Kleid',
                    'Anzug'
                ],
                'sizes' => [
                    'S', 'M', 'L', 'XL', 'XXL'
                ]
            ],
            'bottomClothes' => [
                'items' => [
                    'Jeans',
                    'Jogginghose'
                ],
                'sizes' => [
                    'W30/L32',
                    'W31/L30',
                    'W32/L32',
                    'W33/L34',
                    'W36/L30',
                    'W40/L32'
                ]
            ],
            'miscClothes' => [
                'items' => [
                    'Haube',
                    'Handschuhe'
                ]
            ],
            'misc' => [
                'items' => [
                    'Keyboard',
                    'Beamer-Wand',
                    'Festplatte',
                    'Klangschalenset',
                    'Puzzle',
                    'Kinder-DVD',
                    'Überraschungsgeschenk',
                    'Handtuch',
                    'Fitness-Studio Abo'
                ]
            ]
        ];

        $present = $faker->randomElement($presents);

        $item = $faker->randomElement($present['items']);

        if (array_key_exists('sizes', $present)) {
            $size = $faker->randomElement($present['sizes']);
            return array(
                $item . ', Größe ' . $size,
                '/wish/' . str_slug($item) . '.jpg'
            );
        } else {
            return array(
                $item,
                '/wish/' . str_slug($item) . '.jpg'
            );
        }
    };

    echo 'W';

    $amount = 1;
    if ($faker->boolean(30)) {
        $amount = $faker->numberBetween(2, 20);
    }

    list($name, $img) = $title();

    return [
        'title' => $name,
        'description' => $faker->realText(700),
        'from' => $faker->firstName() . ' ' . $faker->lastName,
        'created_from_user_id' => $atts['created_from_user_id'],
        'image_url' => $img,
        'location_id' => $atts['location_id'],
        'due_date' => $faker->dateTimeBetween('- 30 Days', '+30 days'),
        'published_at' => $faker->dateTimeBetween('- 30 Days', '+10 days'),
        'amount' => $amount
    ];
});
