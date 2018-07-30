<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use SebastianBergmann\CodeCoverage\Report\PHP;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\MenuItem;

class CreateTableSeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'voyager:table-seeder {slug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a table seeder for voyager depending on the current values in the database';

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
        // read args
        $slug = $this->argument('slug');

        // collect data from db
        $dataType = $this->getDataType($slug);
        $dataRows = $this->getDataRows($dataType);

        // calculate values
        $classname = explode('-', $dataType['slug']);
        foreach($classname as $key => $value) {
            $classname[$key] = ucfirst($value);
        }
        $classname = implode('', $classname) . 'TableSeeder';

        // file header
        $code = <<<'CODE'
<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;   


CODE;

        $code .= 'class ' . $classname . ' extends Seeder' . "\n";
        $code .= '{' . "\n";

        // function run
        $tabs = 1;
        $code .= str_repeat(" ", $tabs*4) . 'public function run() {' . "\n";

        $tabs = 2;

        $code .= str_repeat(" ", $tabs*4) . '//Data Type' . "\n";
        $code .= $this->getCodeCreate('$dataType', $dataType, $tabs);

        foreach($dataRows as $dataRow) {
            $code .= str_repeat(" ", $tabs*4) . '//Data Rows: ' . $dataRow['display_name'] . "\n";
            $dataRow['data_type_id'] = '#$dataType[\'id\']#';
            $code .= $this->getCodeCreate('$dataRow', $dataRow, $tabs);
        }

        $code .= str_repeat(" ", $tabs*4) . '//Menu Item' . "\n";

        $menuitem = new MenuItem(
            [
                'menu_id' => 1,
                'target' => '_self',
                'icon_class' => $dataType['icon'],
                'order' => '1',
                'title' => $dataType['display_name_plural'],
                'url' => '',
                'route' => 'voyager.' . $dataType['slug'] . '.index'
            ]);

        $code .= $this->getCodeCreate('$menuItem', $menuitem, $tabs);

        $code .= str_repeat(" ", $tabs*4) . '//Permissions' . "\n";
        $code .= str_repeat(" ", $tabs*4) . "Permission::generateFor('$dataType[name]');" . "\n";

        $tabs = 1;
        $code .= str_repeat(" ", $tabs*4) . '}' . "\n";
        // end function run

        // file footer
        $code .= '}' . "\n";

        // save file
        $file = database_path('seeds/' . $classname . '.php');
        file_put_contents($file, $code);

        $this->info($classname . '.php is created!');
    }

    protected function getDataType($slug)
    {
        return DataType::where('slug', $slug)->first();
    }

    protected function getDataRows($dataType)
    {
        return DataRow::where('data_type_id', $dataType->id)->get();
    }

    protected  function getCodeKeyValuedPairs($atts, $tabs = 4) {
        $return = '';

        foreach ($atts as $key => $value) {
            if ($key === 'id') {
                continue;
            }

            $return .= str_repeat(" ", $tabs*4);
            $return .= "'$key'";

            $return .= str_repeat(' ', max(1, strlen($key) - 20));

            if (is_null($value)) {
                $return .= "=> null,\n";
            }  elseif (is_numeric($value)) {
                $return .= "=> $value,\n";
            } elseif ($value === '') {
                $return .= "=> '',\n";
            } elseif ($value[0] == '#' && $value[strlen($value) - 1] == '#') {
                $value = substr($value, 1, strlen($value) - 2);
                $return .= "=> $value,\n";
            } elseif ($value[0] == '{' && $value[strlen($value) - 1] == '}') {
                $value = str_replace('\\', '\\\\', $value);
                $return .= "=> '$value',\n";
            } else {
                $return .= "=> '$value',\n";
            }
        }
        return $return;
    }

    protected  function getCodeCreate($varname, $model, $tabs) {
        $return = '';

        $return .= str_repeat(" ", $tabs*4) . $varname . ' = \\' . get_class($model) . '::create([' . "\n";
        $return .= $this->getCodeKeyValuedPairs($model->getAttributes(), $tabs + 1);
        $return .= str_repeat(" ", $tabs*4) . ']);' . "\n\n";

        return $return;
    }

}
