<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;   

class FaqsTableSeeder extends Seeder
{
    public function run() {
        //Data Type
        $dataType = \TCG\Voyager\Models\DataType::create([
            'name' => 'faqs',
            'slug' => 'faqs',
            'display_name_singular' => 'FAQ',
            'display_name_plural' => 'FAQs',
            'icon' => 'voyager-question',
            'model_name' => 'App\Faq',
            'policy_name' => null,
            'controller' => null,
            'description' => null,
            'generate_permissions' => 1,
            'server_side' => 0,
            'details' => null,
            'created_at' => '2018-07-19 15:49:26',
            'updated_at' => '2018-07-19 15:50:24',
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

        //Data Rows: Frage
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'question',
            'type' => 'text',
            'display_name' => 'Frage',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => null,
            'order' => 2,
        ]);

        //Data Rows: Antwort
        $dataRow = \TCG\Voyager\Models\DataRow::create([
            'data_type_id' => $dataType['id'],
            'field' => 'answer',
            'type' => 'text_area',
            'display_name' => 'Antwort',
            'required' => 1,
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'details' => null,
            'order' => 3,
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
            'order' => 4,
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
            'order' => 5,
        ]);

        //Menu Item
        $menuItem = \TCG\Voyager\Models\MenuItem::create([
            'menu_id' => 1,
            'target' => '_self',
            'icon_class' => 'voyager-question',
            'order' => 1,
            'title' => 'FAQs',
            'url' => '',
            'route' => 'voyager.faqs.index',
        ]);

        //Permissions
        Permission::generateFor('faqs');
    }
}
