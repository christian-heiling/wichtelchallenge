<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $role = Role::firstOrNew(['name' => 'admin']);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => 'Administrator',
                ])->save();
        }

        $role = Role::firstOrNew(['name' => 'institution']);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => 'Institution',
                ])->save();
        }

        $role = Role::firstOrNew(['name' => 'imp']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => 'Wichtel',
            ])->save();
        }
    }
}
