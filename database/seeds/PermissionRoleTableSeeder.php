<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = Permission::all();

        // Admin
        $role = Role::where('name', 'admin')->firstOrFail();

        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );
    }
}