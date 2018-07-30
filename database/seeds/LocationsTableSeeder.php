<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;   

class LocationsTableSeeder extends Seeder
{
    public function run() {
        //Data Type
        $dataType = \TCG\Voyager\Models\DataType::create([
            'name' => 'locations',
            'slug' => 'locations',
            'display_name_singular' => 'Abgabeort',
            'display_name_plural' => 'Abgabeorte',
            'icon' => 'voyager-location',
            'model_name' => 'App\Location',
            'policy_name' => null,
            'controller' => null,
            'description' => null,
            'generate_permissions' => 1,
            'server_side' => 0,
            'details' => null,
            'created_at' => '2018-07-25 12:24:59',
            'updated_at' => '2018-07-25 12:27:24',
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

        //Data Rows: Name
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'name',
            'type' => 'text',
            'display_name' => 'Name',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => null,
            'order' => 3,
        ]);

        //Data Rows: Straße
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'street',
            'type' => 'text',
            'display_name' => 'Straße',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => null,
            'order' => 5,
        ]);

        //Data Rows: PLZ
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'zip',
            'type' => 'text',
            'display_name' => 'PLZ',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => null,
            'order' => 6,
        ]);

        //Data Rows: Ort
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'city',
            'type' => 'text',
            'display_name' => 'Ort',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => null,
            'order' => 7,
        ]);

        //Data Rows: An Feiertagen geöffnet?
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'open_on_public_holidays',
            'type' => 'checkbox',
            'display_name' => 'An Feiertagen geöffnet?',
            'required' => 1,
            'browse' => 0,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => null,
            'order' => 9,
        ]);

        //Data Rows: Institution Id
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'institution_id',
            'type' => 'text',
            'display_name' => 'Institution Id',
            'required' => 1,
            'browse' => 0,
            'read' => 0,
            'edit' => 0,
            'add' => 0,
            'delete' => 0,
            'details' => null,
            'order' => 2,
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
            'order' => 10,
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
            'order' => 11,
        ]);

        //Data Rows: Institution
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'location_belongsto_institution_relationship',
            'type' => 'relationship',
            'display_name' => 'Institution',
            'required' => 0,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => '{"model":"App\\\\Institution","table":"institutions","type":"belongsTo","column":"institution_id","key":"id","label":"name","pivot_table":"categories","pivot":"0","taggable":"0"}',
            'order' => 4,
        ]);

        //Data Rows: Öffnungszeiten
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'location_hasmany_opening_hour_relationship',
            'type' => 'relationship',
            'display_name' => 'Öffnungszeiten',
            'required' => 0,
            'browse' => 0,
            'read' => 1,
            'edit' => 1,
            'add' => 0,
            'delete' => 1,
            'details' => '{"model":"App\\\\OpeningHour","table":"opening_hours","type":"hasMany","column":"location_id","key":"id","label":"id","pivot_table":"categories","pivot":"0","taggable":"0"}',
            'order' => 8,
        ]);

        //Menu Item
        $menuItem = \TCG\Voyager\Models\MenuItem::create([
            'menu_id' => 1,
            'target' => '_self',
            'icon_class' => 'voyager-location',
            'order' => 1,
            'title' => 'Abgabeorte',
            'url' => '',
            'route' => 'voyager.locations.index',
        ]);

        //Permissions
        Permission::generateFor('locations');
    }
}
