<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;   

class PresentsTableSeeder extends Seeder
{
    public function run() {
        //Data Type
        $dataType = \TCG\Voyager\Models\DataType::create([
            'name' => 'presents',
            'slug' => 'presents',
            'display_name_singular' => 'Geschenk',
            'display_name_plural' => 'Geschenke',
            'icon' => 'voyager-gift',
            'model_name' => 'App\Present',
            'policy_name' => 'App\Policies\PresentPolicy',
            'controller' => null,
            'description' => null,
            'generate_permissions' => 1,
            'server_side' => 1,
            'details' => null,
            'created_at' => '2018-07-26 13:00:49',
            'updated_at' => '2018-07-26 21:52:04',
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

        //Data Rows: Wish Id
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'wish_id',
            'type' => 'text',
            'display_name' => 'Wish Id',
            'required' => 1,
            'browse' => 0,
            'read' => 0,
            'edit' => 0,
            'add' => 0,
            'delete' => 0,
            'details' => null,
            'order' => 4,
        ]);

        //Data Rows: From User Id
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'from_user_id',
            'type' => 'text',
            'display_name' => 'From User Id',
            'required' => 1,
            'browse' => 0,
            'read' => 0,
            'edit' => 0,
            'add' => 0,
            'delete' => 0,
            'details' => null,
            'order' => 6,
        ]);

        //Data Rows: State
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'state',
            'type' => 'text',
            'display_name' => 'State',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => null,
            'order' => 7,
        ]);

        //Data Rows: Due Date
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'due_date',
            'type' => 'timestamp',
            'display_name' => 'Due Date',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => null,
            'order' => 8,
        ]);

        //Data Rows: Amount
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'amount',
            'type' => 'number',
            'display_name' => 'Amount',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
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

        //Data Rows: Wish
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'present_belongsto_wish_relationship',
            'type' => 'relationship',
            'display_name' => 'Wish',
            'required' => 0,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => '{"model":"App\\\\Wish","table":"wishes","type":"belongsTo","column":"wish_id","key":"id","label":"title","pivot_table":"categories","pivot":"0","taggable":"0"}',
            'order' => 3,
        ]);

        //Data Rows: From
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'present_belongsto_user_relationship',
            'type' => 'relationship',
            'display_name' => 'From',
            'required' => 0,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => '{"model":"App\\\\User","table":"users","type":"belongsTo","column":"from_user_id","key":"id","label":"name","pivot_table":"categories","pivot":"0","taggable":"0"}',
            'order' => 5,
        ]);

        //Data Rows: messages
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'present_hasmany_message_relationship',
            'type' => 'relationship',
            'display_name' => 'messages',
            'required' => 0,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 0,
            'delete' => 1,
            'details' => '{"model":"App\\\\Message","table":"messages","type":"hasMany","column":"present_id","key":"id","label":"id","pivot_table":"categories","pivot":"0","taggable":"0"}',
            'order' => 9,
        ]);

        //Menu Item
        $menuItem = \TCG\Voyager\Models\MenuItem::create([
            'menu_id' => 1,
            'target' => '_self',
            'icon_class' => 'voyager-gift',
            'order' => 1,
            'title' => 'Geschenke',
            'url' => '',
            'route' => 'voyager.presents.index',
        ]);

        //Permissions
        Permission::generateFor('presents');
    }
}
