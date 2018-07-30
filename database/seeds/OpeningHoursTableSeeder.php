<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;   

class OpeningHoursTableSeeder extends Seeder
{
    public function run() {
        //Data Type
        $dataType = \TCG\Voyager\Models\DataType::create([
            'name' => 'opening_hours',
            'slug' => 'opening-hours',
            'display_name_singular' => 'Öffnungszeit',
            'display_name_plural' => 'Öffnungszeiten',
            'icon' => 'voyager-alarm-clock',
            'model_name' => 'App\OpeningHour',
            'policy_name' => null,
            'controller' => null,
            'description' => null,
            'generate_permissions' => 1,
            'server_side' => 1,
            'details' => null,
            'created_at' => '2018-07-19 15:49:26',
            'updated_at' => '2018-07-19 15:57:04',
        ]);

        //Data Rows: Id
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'id',
            'type' => 'text',
            'display_name' => 'Id',
            'required' => 1,
            'browse' => 0,
            'read' => 0,
            'edit' => 0,
            'add' => 0,
            'delete' => 0,
            'details' => null,
            'order' => 1,
        ]);

        //Data Rows: Location Id
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'location_id',
            'type' => 'text',
            'display_name' => 'Location Id',
            'required' => 1,
            'browse' => 0,
            'read' => 0,
            'edit' => 0,
            'add' => 0,
            'delete' => 0,
            'details' => null,
            'order' => 3,
        ]);

        //Data Rows: Wochentag (0 .. Mo, 6 .. So)
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'weekday',
            'type' => 'number',
            'display_name' => 'Wochentag (0 .. Mo, 6 .. So)',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => null,
            'order' => 4,
        ]);

        //Data Rows: Von
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'from',
            'type' => 'time',
            'display_name' => 'Von',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => null,
            'order' => 5,
        ]);

        //Data Rows: Bis
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'to',
            'type' => 'time',
            'display_name' => 'Bis',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => null,
            'order' => 6,
        ]);

        //Data Rows: Created At
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'created_at',
            'type' => 'timestamp',
            'display_name' => 'Created At',
            'required' => 0,
            'browse' => 0,
            'read' => 0,
            'edit' => 0,
            'add' => 0,
            'delete' => 0,
            'details' => null,
            'order' => 7,
        ]);

        //Data Rows: Updated At
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'updated_at',
            'type' => 'timestamp',
            'display_name' => 'Updated At',
            'required' => 0,
            'browse' => 0,
            'read' => 0,
            'edit' => 0,
            'add' => 0,
            'delete' => 0,
            'details' => null,
            'order' => 8,
        ]);

        //Data Rows: Abgabeort
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'opening_hour_belongsto_location_relationship',
            'type' => 'relationship',
            'display_name' => 'Abgabeort',
            'required' => 0,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => '{"model":"App\\\\Location","table":"locations","type":"belongsTo","column":"location_id","key":"id","label":"name","pivot_table":"categories","pivot":"0","taggable":"0"}',
            'order' => 2,
        ]);

        //Menu Item
        $menuItem = \TCG\Voyager\Models\MenuItem::create([
            'menu_id' => 1,
            'target' => '_self',
            'icon_class' => 'voyager-alarm-clock',
            'order' => 1,
            'title' => 'Öffnungszeiten',
            'url' => '',
            'route' => 'voyager.opening-hours.index',
        ]);

        //Permissions
        Permission::generateFor('opening_hours');
    }
}
