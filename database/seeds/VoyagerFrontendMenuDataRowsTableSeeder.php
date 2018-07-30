<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

class VoyagerFrontendMenuDataRowsTableSeeder extends Seeder
{
    public function run()
    {
        $this->createMainMenu();
        $this->createSocialMenu();
    }

    protected function createMainMenu()
    {
        // Create a new menu
        Menu::firstOrCreate([
            'name' => 'primary',
        ]);
        $menu = Menu::where('name', 'primary')->firstOrFail();

        // Fill out that menu
        $this->createMenuItem($menu->id, 'Blog', '/blog', 1);
        $this->createMenuItem($menu->id, 'Über uns', '/about', 2);
        $this->createMenuItem($menu->id, 'Kontakt', '/contact', 3);
    }

    protected function createSocialMenu()
    {
        // Create a new menu
        Menu::firstOrCreate([
            'name' => 'social',
        ]);
        $menu = Menu::where('name', 'social')->firstOrFail();

        // Fill out that menu
        $this->createMenuItem(
            $menu->id,
            'Facebook',
            'https://www.facebook.com/WienerWichtelChallenge/',
            1,
            '_blank',
            'fa-facebook-square'
        );
        $this->createMenuItem(
            $menu->id,
            'Instagram',
            'https://www.instagram.com/insta_wichtel_2017/?hl=de',
            2,
            '_blank',
            'fa-instagram'
        );
    }


    protected function createMenuItem($menuId, $title, $url, $order, $target = '_self', $icon = '')
    {
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menuId,
            'title' => $title,
            'url' => $url,
            'route' => null,
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target' => $target,
                'icon_class' => $icon,
                'color' => null,
                'parent_id' => null,
                'order' => $order,
            ])->save();
        }

        return $menuItem;
    }
}
