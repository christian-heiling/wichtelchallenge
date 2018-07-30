<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;   

class MessagesTableSeeder extends Seeder
{
    public function run() {
        //Data Type
        $dataType = \TCG\Voyager\Models\DataType::create([
            'name' => 'messages',
            'slug' => 'messages',
            'display_name_singular' => 'Nachrichten',
            'display_name_plural' => 'Nachrichten',
            'icon' => 'voyager-bubble',
            'model_name' => 'App\Message',
            'policy_name' => null,
            'controller' => null,
            'description' => null,
            'generate_permissions' => 1,
            'server_side' => 1,
            'details' => null,
            'created_at' => '2018-07-18 13:30:59',
            'updated_at' => '2018-07-18 13:32:27',
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

        //Data Rows: From User Id
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'from_user_id',
            'type' => 'text',
            'display_name' => 'From User Id',
            'required' => 0,
            'browse' => 0,
            'read' => 0,
            'edit' => 0,
            'add' => 0,
            'delete' => 0,
            'details' => null,
            'order' => 4,
        ]);

        //Data Rows: Present Id
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'present_id',
            'type' => 'text',
            'display_name' => 'Present Id',
            'required' => 1,
            'browse' => 0,
            'read' => 0,
            'edit' => 0,
            'add' => 0,
            'delete' => 0,
            'details' => null,
            'order' => 8,
        ]);

        //Data Rows: Inhalt
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'content',
            'type' => 'rich_text_box',
            'display_name' => 'Inhalt',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => null,
            'order' => 6,
        ]);

        //Data Rows: Am
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'created_at',
            'type' => 'timestamp',
            'display_name' => 'Am',
            'required' => 0,
            'browse' => 1,
            'read' => 1,
            'edit' => 0,
            'add' => 0,
            'delete' => 1,
            'details' => null,
            'order' => 2,
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
            'order' => 9,
        ]);

        //Data Rows: Von
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'message_belongsto_user_relationship',
            'type' => 'relationship',
            'display_name' => 'Von',
            'required' => 0,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => '{"model":"App\\\\User","table":"users","type":"belongsTo","column":"from_user_id","key":"id","label":"name","pivot_table":"categories","pivot":"0","taggable":"0"}',
            'order' => 3,
        ]);

        //Data Rows: Geschenk
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'message_belongsto_present_relationship',
            'type' => 'relationship',
            'display_name' => 'Geschenk',
            'required' => 0,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => '{"model":"App\\\\Present","table":"presents","type":"belongsTo","column":"present_id","key":"id","label":"display","pivot_table":"categories","pivot":"0","taggable":"0"}',
            'order' => 7,
        ]);

        //Menu Item
        $menuItem = \TCG\Voyager\Models\MenuItem::create([
            'menu_id' => 1,
            'target' => '_self',
            'icon_class' => 'voyager-bubble',
            'order' => 1,
            'title' => 'Nachrichten',
            'url' => '',
            'route' => 'voyager.messages.index',
        ]);

        //Permissions
        Permission::generateFor('messages');
    }
}
