<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;   

class WishesTableSeeder extends Seeder
{
    public function run() {
        //Data Type
        $dataType = \TCG\Voyager\Models\DataType::create([
            'name' => 'wishes',
            'slug' => 'wishes',
            'display_name_singular' => 'Wunsch',
            'display_name_plural' => 'Wünsche',
            'icon' => 'voyager-wand',
            'model_name' => 'App\Wish',
            'policy_name' => 'App\Policies\WishPolicy',
            'controller' => null,
            'description' => null,
            'generate_permissions' => 1,
            'server_side' => 1,
            'details' => NULL,
            'created_at' => '2018-07-18 13:30:59',
            'updated_at' => '2018-07-18 13:36:10',
        ]);

        //Data Rows: ID
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'id',
            'type' => 'number',
            'display_name' => 'ID',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 0,
            'add' => 0,
            'delete' => 0,
            'details' => null,
            'order' => 1,
        ]);

        //Data Rows: State
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'state',
            'type' => 'text',
            'display_name' => 'Status',
            'required' => 1,
            'browse' => 0,
            'read' => 1,
            'edit' => 0,
            'add' => 0,
            'delete' => 0,
            'details' => null,
            'order' => 3,
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
            'order' => 4,
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
            'order' => 6,
        ]);

        //Data Rows: Erstellt am
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'created_at',
            'type' => 'timestamp',
            'display_name' => 'Erstellt am',
            'required' => 0,
            'browse' => 0,
            'read' => 1,
            'edit' => 0,
            'add' => 0,
            'delete' => 0,
            'details' => null,
            'order' => 15,
        ]);

        //Data Rows: Aktualisiert am
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'updated_at',
            'type' => 'timestamp',
            'display_name' => 'Aktualisiert am',
            'required' => 0,
            'browse' => 0,
            'read' => 0,
            'edit' => 0,
            'add' => 0,
            'delete' => 0,
            'details' => null,
            'order' => 15,
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

        //Data Rows: Titel
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'title',
            'type' => 'text',
            'display_name' => 'Titel',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => null,
            'order' => 3,
        ]);

        //Data Rows: Von
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'from',
            'type' => 'text',
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

        //Data Rows: Created From User Id
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'created_from_user_id',
            'type' => 'text',
            'display_name' => 'Created From User Id',
            'required' => 1,
            'browse' => 0,
            'read' => 0,
            'edit' => 0,
            'add' => 0,
            'delete' => 0,
            'details' => null,
            'order' => 17,
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
            'order' => 8,
        ]);

        //Data Rows: Menge
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'amount',
            'type' => 'number',
            'display_name' => 'Menge',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => null,
            'order' => 2,
        ]);

        //Data Rows: Publiziert am
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'published_at',
            'type' => 'timestamp',
            'display_name' => 'Publiziert am',
            'required' => 1,
            'browse' => 0,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => null,
            'order' => 12,
        ]);

        //Data Rows: letzter Abgabezeitpunkt
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'due_date',
            'type' => 'timestamp',
            'display_name' => 'letzter Abgabezeitpunkt',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => null,
            'order' => 10,
        ]);

        //Data Rows: Erstellt am
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'created_at',
            'type' => 'timestamp',
            'display_name' => 'Erstellt am',
            'required' => 0,
            'browse' => 0,
            'read' => 1,
            'edit' => 0,
            'add' => 0,
            'delete' => 0,
            'details' => null,
            'order' => 15,
        ]);

        //Data Rows: Aktualisiert am
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'updated_at',
            'type' => 'timestamp',
            'display_name' => 'Aktualisiert am',
            'required' => 0,
            'browse' => 0,
            'read' => 0,
            'edit' => 0,
            'add' => 0,
            'delete' => 0,
            'details' => null,
            'order' => 15,
        ]);

        //Data Rows: Abgabeort
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'wish_belongsto_location_relationship',
            'type' => 'relationship',
            'display_name' => 'Abgabeort',
            'required' => 0,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => '{"model":"App\\\\Location","table":"locations","type":"belongsTo","column":"location_id","key":"id","label":"name","pivot_table":"categories","pivot":"0","taggable":"0"}',
            'order' => 7,
        ]);

        //Data Rows: ErstellerIn
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'wish_belongsto_user_relationship',
            'type' => 'relationship',
            'display_name' => 'ErstellerIn',
            'required' => 0,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => '{"model":"App\\\\User","table":"users","type":"belongsTo","column":"created_from_user_id","key":"id","label":"name","pivot_table":"categories","pivot":"0","taggable":"0"}',
            'order' => 13,
        ]);

        //Data Rows: Geschenke
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'wish_hasmany_present_relationship',
            'type' => 'relationship',
            'display_name' => 'Geschenke',
            'required' => 0,
            'browse' => 0,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => '{"model":"App\\\\Present","table":"presents","type":"hasMany","column":"wish_id","key":"id","label":"display","pivot_table":"categories","pivot":"0","taggable":"0"}',
            'order' => 16,
        ]);

        //Menu Item
        $menuItem = \TCG\Voyager\Models\MenuItem::create([
            'menu_id' => 1,
            'target' => '_self',
            'icon_class' => 'voyager-wand',
            'order' => 1,
            'title' => 'Wünsche',
            'url' => '',
            'route' => 'voyager.wishes.index',
        ]);

        //Permissions
        Permission::generateFor('wishes');

        $additionalPermissions = [
            'publish_wishes',
            'unpublish_wishes'
        ];

        foreach($additionalPermissions as $p) {
            Permission::firstOrCreate([
                'key'        => $p,
                'table_name' => 'wishes',
            ]);
        }
    }
}
