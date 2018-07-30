<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use TCG\Voyager\Traits\Seedable;

class VoyagerDummyDatabaseSeeder extends Seeder
{
    use Seedable;

    protected $seedersPath;

    /**
     * Run the database seeds.
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

        //$this->seed('PermissionRoleTableSeeder');
    }
}
