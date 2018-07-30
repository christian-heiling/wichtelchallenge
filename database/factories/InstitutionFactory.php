<?php

use Faker\Generator as Faker;

$factory->define(App\Institution::class, function (Faker $faker) {

    echo 'I';

    $name = function() use ($faker) {
        $names = [
            'Vinzi' => [
                'Bett',
                'Rast',
                'Port'
            ],
            'Caritas ' => [
                'Sozialberatung',
                'Fremdenrechtsberatung',
                'Asylzentrum',
                'Sozial- und Rückkehrberatung',
                'P7 - Wiener Service für Wohnungslose',
                'FrauenWohnZentrum',
                'Haus Miriam - Notschlafstelle für Frauen',
                'JUCA - Notschlafstelle',
                'Gruft',
                'Zweite Gruft',
                'Rupert Mayer Haus',
                'Winternotquartier U63',
                'Vinzenzhaus',
                'a_way',
                'Winternotquartier und Wärmestube Grangasse',
                'Winternotquartier Lacknergasse',
                'Winternotqurtier Breitenfurterstraße',
                'Winternotquartier Waldgasse',
                'Tageszentrum am Hauptbahnhof',
                'Le+O - Lebensmittel und Orientierung',
                'Canisibus',
                'Louise-Bus',
                'carla mittersteig',
                'carla süd',
                'Heimhilfe',
                'Haus St. Barbara',
                'Haus Schönbrunn',
                'Haus St. Elisabeth'
            ],
            'Häuser zum Leben - Haus ' => [
                'Augarten',
                'Prater',
                'Maria Jacobi',
                'Wieden',
                'Margareten',
                'Mariahilf',
                'Neubau',
                'Rossau',
                'Laaerberg',
                'Wienerberg',
                'Hetzendorf',
                'Föhrenhof',
                'Rosenberg',
                'Trazerberg',
                'Gustav Klimt',
                'Penzing',
                'Rudolfsheim',
                'Schmelz',
                'Liebhartstal',
                'Alszeile',
                'An der Türkenschanze',
                'Hohe Warte',
                'Döbling',
                'Brigittenau',
                'Jedlersdorf',
                'Leopoldau',
                'Tamariske-Sonnenhof',
                'Am Mühlengrund',
                'Atzgersdorf'
            ],
            'VWJ - ' => [
                'J.at',
                'Jugendräume Wehlistraße',
                'Jugendtreff Norbahnhof',
                'Jugendzentrum come2gether',
                '5erHaus',
                'Back on Stage 5',
                'CU television',
                'Flash Mädchencafe',
                'Zentrum 9',
                'Back on Stage 10',
                'Jugendtreff Arthaberbad',
                'Jugendtreff Sonnwendviertel',
                'Jugendzentrum Hansonsiedlung',
                'JUST@KlubKW',
                'JUST@OPS',
                'spacelab_kreativ',
                'J.A.M.',
                'si:Ju',
                'Jugendzentrum Meidling',
                'spacelab_girls',
                'Back on Stage 16/17',
                'JugendZone 16',
                '19 KMH',
                'BasE 20',
                'spacelab_gestaltung',
                'Club Nautilus Großfeldsiedlung',
                'Jugendtreff MIHO',
                'Jugendzentrum Marco Polo',
                'spacelab_umwelt',
                'Jugendtreff Donaustadt',
                'Mobile Jugendarbeit SEA',
                'Jugendzentrum Alterlaa'
            ]
        ];

        $concated_names = [];
        foreach($names as $name_prefix => $name) {
            if (is_array($name)) {
                foreach($name as $name_suffix) {
                    $concated_names[] = $name_prefix . $name_suffix;
                }
            } else {
                $concated_names[] = $name;
            }
        }

        return $faker->randomElement($concated_names);
    };

    return [
        'name' => $name(),
        'image_url' => $faker->imageUrl(520,250),
        'description' => $faker->realText(),
        'area_of_activity' => $faker->randomElement(\App\Institution::availableAreaOfActivities())
    ];
});
