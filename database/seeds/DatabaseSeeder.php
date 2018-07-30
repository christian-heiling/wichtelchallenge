<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use TCG\Voyager\Traits\Seedable as Seedable;

class DatabaseSeeder extends Seeder
{
    use Seedable;

    protected $seedersPath;

    const INSTITUTION_AMOUNT = 25;

    const FAQ_AMOUNT = 5;

    const LOCATIONS_PER_INSTITUTION_MIN = 1;
    const LOCATIONS_PER_INSTITUTION_MAX = 3;

    const WISHES_PER_USER_FROM_INSTITUTION_MIN = 3;
    const WISHES_PER_USER_FROM_INSTITUTION_MAX = 20;

    const PRESENT_PER_IMP_USER_MIN = 1;
    const PRESENT_PER_IMP_USER_MAX = 3;

    const MESSAGES_PER_USER_PER_WISH_MIN = 1;
    const MESSAGES_PER_USER_PER_WISH_MAX = 3;

    const WORKINGDAYS_MIN = 2;
    const WORKINGDAYS_MAX = 7;

    const IMP_AMOUNT = 200;

    private $faker;

    private $wishes;
    private $institutions;
    private $administratorUsers;
    private $institutionUsers;
    private $impUsers;

    public function __construct()
    {
        $this->faker = Faker::create();
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->seedersPath = database_path('seeds').'/';
        $this->seed('MessagesTableSeeder');

        $this->seed('WishesTableSeeder');
        $this->seed('PresentsTableSeeder');

        $this->seed('InstitutionsTableSeeder');
        $this->seed('LocationsTableSeeder');
        $this->seed('OpeningHoursTableSeeder');

        $this->seed('FaqsTableSeeder');

        $this->seed('PermissionRoleTableSeeder');
        $this->seed('PermissionRoleInstitutionImpTableSeeder');

        $this->seed('VoyagerFrontendMenuDataRowsTableSeeder');
        $this->wishes = [];

        // create admin
        $this->administratorUsers = factory(App\User::class, 1)
            ->create([
                'role_id' => 1,
                'name' => 'Wiener Wichtel Challenge',
                'email' => 'admin@wienerwichtelchallenge.at'
            ]);

        // create faq
        factory(App\Faq::class, self::FAQ_AMOUNT)->create();

        // create institutions
        $this->institutions = factory(App\Institution::class, self::INSTITUTION_AMOUNT)->create();

        foreach($this->institutions as $institution) {

            // create locations
            $locations = factory(App\Location::class, $this->faker->biasedNumberBetween(self::LOCATIONS_PER_INSTITUTION_MIN, self::LOCATIONS_PER_INSTITUTION_MAX))
                ->create([
                    'institution_id' => $institution->id
                ]);

            foreach($locations as $location) {
                $this->createWorkingHours($location);
            }
        }

        echo "\n";

        // create users from institutions
        for($i = 0; $i < 10; $i++) {
            $this->institutionUsers = factory(App\User::class, 1)
                ->create([
                    'role_id' => 2,
                    'institution_id' => $this->faker->randomElement($this->institutions->all())
                ])->each(function($user) {

                    // create wishes
                    $wish_amout = $this->faker->biasedNumberBetween(self::WISHES_PER_USER_FROM_INSTITUTION_MIN, self::WISHES_PER_USER_FROM_INSTITUTION_MAX);
                    for($i = 0; $i <= $wish_amout; $i++) {
                        $wish = factory(App\Wish::class, 1)
                            ->create([
                                'created_from_user_id' => $user->id,
                                'location_id' => $this->faker->randomElement(
                                    $user->institution()->get()->first()->locations()->get()->all()
                                )
                            ]);

                        $this->wishes[] = $wish;
                    }
                });
        }

        echo "\n";

        // create imp users
        $this->impUsers = factory(App\User::class, self::IMP_AMOUNT)->create(array('role_id' => 3));
        foreach($this->impUsers as $user) {

            // create presents
            $present_count = $this->faker->biasedNumberBetween(self::PRESENT_PER_IMP_USER_MIN, self::PRESENT_PER_IMP_USER_MAX);
            for ($i = 0; $i <= $present_count; $i++) {

                $wish = $this->faker->randomElement($this->wishes)->first();
                $present = factory(App\Present::class, 1)
                    ->create([
                        'from_user_id' => $user->id,
                        'wish_id' => $wish->id
                    ])->first();

                // create messages
                factory(App\Message::class, $this->faker->biasedNumberBetween(self::MESSAGES_PER_USER_PER_WISH_MIN, self::MESSAGES_PER_USER_PER_WISH_MAX))
                    ->create([
                        'from_user_id' => $user->id,
                        'present_id' => $present->id
                    ]);

                // create messages
                factory(App\Message::class, $this->faker->biasedNumberBetween(self::MESSAGES_PER_USER_PER_WISH_MIN, self::MESSAGES_PER_USER_PER_WISH_MAX))
                    ->create([
                        'from_user_id' => $wish->created_from_user_id,
                        'present_id' => $present->id
                    ]);

                $this->wishes[] = $wish;
            }
        }

    }

    private function getAvailableWorkingHours() {
        return [
            '06:00',
            '07:00',
            '08:00',
            '08:30',
            '09:00',
            '10:00',
            '12:00',
            '13:00',
            '15:00',
            '17:00',
            '18:00',
            '19:00',
            '20:00'
        ];
    }

    private function getAvailableWeekdays() {
        return [0, 1, 2, 3, 4, 5, 6];
    }

    private function selectNumbers($amount, $max_number = 100) {
        $numbers = [];
        for($i = 0; $i < $amount; $i++) {
            $prev_number = 0;
            if ($i != 0) {
                $prev_number = $numbers[$i-1];
            }

            $new_number = $max_number / $amount;
            $new_number = round($new_number);
            $new_number = $this->faker->numberBetween(1, 1+$new_number);
            $new_number += $prev_number;
            $new_number = $new_number % $max_number;

            $numbers[] = $new_number;
        }
        return $numbers;
    }

    private function createWorkingHours($location) {

        // select weekdays
        $weekdays = $this->faker->randomElements(
            $this->getAvailableWeekdays(),
            $this->faker->biasedNumberBetween(
                self::WORKINGDAYS_MIN,
                self::WORKINGDAYS_MAX
            )
        );

        foreach($weekdays as $weekday) {
            $hasMiddayBreak = $this->faker->boolean;
            $working_hours = $this->getAvailableWorkingHours();

            if ($hasMiddayBreak) {
                $indexes = $this->selectNumbers(4, count($working_hours));

                factory(App\OpeningHour::class, 1)
                    ->create([
                        'weekday' => $weekday,
                        'location_id' => $location->id,
                        'from' => $working_hours[$indexes[0]],
                        'to' => $working_hours[$indexes[1]]
                    ]);

                factory(App\OpeningHour::class, 1)
                    ->create([
                        'weekday' => $weekday,
                        'location_id' => $location->id,
                        'from' => $working_hours[$indexes[2]],
                        'to' => $working_hours[$indexes[3]]
                    ]);

            } else {
                $indexes = $this->selectNumbers(2, count($working_hours));

                factory(App\OpeningHour::class, 1)
                    ->create([
                        'weekday' => $weekday,
                        'location_id' => $location->id,
                        'from' => $working_hours[$indexes[0]],
                        'to' => $working_hours[$indexes[1]]
                    ]);
            }
        }
    }
}
