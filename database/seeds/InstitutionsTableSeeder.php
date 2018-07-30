<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;   

class InstitutionsTableSeeder extends Seeder
{
    public function run() {
        //Data Type
        $dataType = \TCG\Voyager\Models\DataType::create([
            'name' => 'institutions',
            'slug' => 'institutions',
            'display_name_singular' => 'Institution',
            'display_name_plural' => 'Institutionen',
            'icon' => 'voyager-company',
            'model_name' => 'App\Institution',
            'policy_name' => null,
            'controller' => null,
            'description' => null,
            'generate_permissions' => 1,
            'server_side' => 0,
            'details' => null,
            'created_at' => '2018-07-19 16:31:15',
            'updated_at' => '2018-07-19 16:34:27',
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
            'order' => 2,
        ]);

        //Data Rows: Bild
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'image_url',
            'type' => 'image',
            'display_name' => 'Bild',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => null,
            'order' => 4,
        ]);

        //Data Rows: Beschreibung
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'description',
            'type' => 'rich_text_box',
            'display_name' => 'Beschreibung',
            'required' => 1,
            'browse' => 0,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => null,
            'order' => 3,
        ]);

        //Data Rows: Tätigkeitsfeld
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'area_of_activity',
            'type' => 'text',
            'display_name' => 'Tätigkeitsfeld',
            'required' => 1,
            'browse' => 0,
            'read' => 0,
            'edit' => 0,
            'add' => 0,
            'delete' => 0,
            'details' => null,
            'order' => 5,
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
            'order' => 6,
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
            'order' => 7,
        ]);

        //Data Rows: Abgabeorte
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'institution_hasmany_location_relationship_1',
            'type' => 'relationship',
            'display_name' => 'Abgabeorte',
            'required' => 0,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => '{"model":"App\\\\Location","table":"locations","type":"hasMany","column":"institution_id","key":"id","label":"name","pivot_table":"categories","pivot":"0","taggable":"0"}',
            'order' => 8,
        ]);

        //Data Rows: Users
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'institution_hasmany_user_relationship_1',
            'type' => 'relationship',
            'display_name' => 'Users',
            'required' => 0,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => '{"model":"App\\\\User","table":"users","type":"hasMany","column":"institution_id","key":"id","label":"name","pivot_table":"categories","pivot":"0","taggable":"0"}',
            'order' => 9,
        ]);

        //Menu Item
        $menuItem = \TCG\Voyager\Models\MenuItem::create([
            'menu_id' => 1,
            'target' => '_self',
            'icon_class' => 'voyager-company',
            'order' => 1,
            'title' => 'Institutionen',
            'url' => '',
            'route' => 'voyager.institutions.index',
        ]);

        //Permissions
        Permission::generateFor('institutions');
    }
}
