<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use TCG\Voyager\Models\Role;

class CreatePermissionRoleSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'voyager:permission-seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a seeder for voyager depending on the current role permissions in the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // calculate values
        $classname = 'PermissionRoleInstitutionImpTableSeeder';

        $institutionPermissionIds = Role::where('name', 'institution')->firstOrFail()->permissions()->pluck('id')->all();
        $impPermissionIds = Role::where('name', 'imp')->firstOrFail()->permissions()->pluck('id')->all();

        // file header
        $code = <<<'CODE'
<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class PermissionRoleInstitutionImpTableSeeder extends Seeder
{
    public function run()
    {
        // Institution
        $role = Role::where('name', 'institution')->firstOrFail();

        $role->permissions()->sync(
CODE;

        $code .= "\n" . str_repeat(" ", 3*4) . '[' . implode(', ', $institutionPermissionIds) . ']' . "\n";

        $code .= <<<'CODE'
        );
        
        // Imp
        $role = Role::where('name', 'imp')->firstOrFail();

        $role->permissions()->sync(
CODE;

        $code .= "\n" . str_repeat(" ", 3*4) . '[' . implode(', ', $impPermissionIds) . ']' . "\n";

        $code .= <<<'CODE'
        );
    }
}
CODE;

        // save file
        $file = database_path('seeds/' . $classname . '.php');
        file_put_contents($file, $code);

        $this->info($classname . '.php is created!');
    }
}
