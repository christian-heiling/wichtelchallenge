<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Category;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Page;
use TCG\Voyager\Models\Translation;

class TranslationsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $this->dataTypesTranslations();
        $this->categoriesTranslations();
        $this->pagesTranslations();
        $this->menusTranslations();
    }

    /**
     * Auto generate Categories Translations.
     *
     * @return void
     */
    private function categoriesTranslations()
    {
        // Adding translations for 'categories'
        //
        $cat = Category::where('slug', 'category-1')->firstOrFail();
        if ($cat->exists) {
            $this->trans('de', $this->arr(['categories', 'slug'], $cat->id), 'Kategorie 1');
            $this->trans('de', $this->arr(['categories', 'name'], $cat->id), 'Kategorie 2');
        }
        $cat = Category::where('slug', 'category-2')->firstOrFail();
        if ($cat->exists) {
            $this->trans('de', $this->arr(['categories', 'slug'], $cat->id), 'kategorie-1');
            $this->trans('de', $this->arr(['categories', 'name'], $cat->id), 'kategorie-2');
        }
    }

    /**
     * Auto generate DataTypes Translations.
     *
     * @return void
     */
    private function dataTypesTranslations()
    {
        // Adding translations for 'display_name_singular'
        //
        $_fld = 'display_name_singular';
        $_tpl = ['data_types', $_fld];
        $dtp = DataType::where($_fld, 'Post')->firstOrFail();
        if ($dtp->exists) {
            $this->trans('de', $this->arr($_tpl, $dtp->id), 'Beitrag');
        }
        $dtp = DataType::where($_fld, 'Page')->firstOrFail();
        if ($dtp->exists) {
            $this->trans('de', $this->arr($_tpl, $dtp->id), 'Seite');
        }
        $dtp = DataType::where($_fld, 'User')->firstOrFail();
        if ($dtp->exists) {
            $this->trans('de', $this->arr($_tpl, $dtp->id), 'User');
        }
        $dtp = DataType::where($_fld, 'Category')->firstOrFail();
        if ($dtp->exists) {
            $this->trans('de', $this->arr($_tpl, $dtp->id), 'Kategorie');
        }
        $dtp = DataType::where($_fld, 'Menu')->firstOrFail();
        if ($dtp->exists) {
            $this->trans('de', $this->arr($_tpl, $dtp->id), 'Menü');
        }
        $dtp = DataType::where($_fld, 'Role')->firstOrFail();
        if ($dtp->exists) {
            $this->trans('de', $this->arr($_tpl, $dtp->id), 'Rolle');
        }

        // Adding translations for 'display_name_plural'
        //
        $_fld = 'display_name_plural';
        $_tpl = ['data_types', $_fld];
        $dtp = DataType::where($_fld, 'Posts')->firstOrFail();
        if ($dtp->exists) {
            $this->trans('de', $this->arr($_tpl, $dtp->id), 'Beiträge');
        }
        $dtp = DataType::where($_fld, 'Pages')->firstOrFail();
        if ($dtp->exists) {
            $this->trans('de', $this->arr($_tpl, $dtp->id), 'Seiten');
        }
        $dtp = DataType::where($_fld, 'Users')->firstOrFail();
        if ($dtp->exists) {
            $this->trans('de', $this->arr($_tpl, $dtp->id), 'Users');
        }
        $dtp = DataType::where($_fld, 'Categories')->firstOrFail();
        if ($dtp->exists) {
            $this->trans('de', $this->arr($_tpl, $dtp->id), 'Kategorien');
        }
        $dtp = DataType::where($_fld, 'Menus')->firstOrFail();
        if ($dtp->exists) {
            $this->trans('de', $this->arr($_tpl, $dtp->id), 'Menüs');
        }
        $dtp = DataType::where($_fld, 'Roles')->firstOrFail();
        if ($dtp->exists) {
            $this->trans('de', $this->arr($_tpl, $dtp->id), 'Rolen');
        }
    }

    /**
     * Auto generate Pages Translations.
     *
     * @return void
     */
    private function pagesTranslations()
    {
        $page = Page::where('slug', 'hello-world')->firstOrFail();
        if ($page->exists) {
            $_arr = $this->arr(['pages', 'title'], $page->id);
            $this->trans('de', $_arr, 'Hallo Welt');
            /**
             * For configuring additional languages use it e.g.
             *
             * ```
             *   $this->trans('es', $_arr, 'hola-mundo');
             *   $this->trans('de', $_arr, 'hallo-welt');
             * ```
             */
            $_arr = $this->arr(['pages', 'slug'], $page->id);
            $this->trans('de', $_arr, 'hallo-welt');

            $_arr = $this->arr(['pages', 'body'], $page->id);
            $this->trans('de', $_arr,
                '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. 
                </p><p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. 
                </p><p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. 
                </p>'
            );
        }
    }

    /**
     * Auto generate Menus Translations.
     *
     * @return void
     */
    private function menusTranslations()
    {
        $_tpl = ['menu_items', 'title'];
        $_item = $this->findMenuItem('Dashboard');
        if ($_item->exists) {
            $this->trans('de', $this->arr($_tpl, $_item->id), 'Dashboard');
        }

        $_item = $this->findMenuItem('Media');
        if ($_item->exists) {
            $this->trans('de', $this->arr($_tpl, $_item->id), 'Medien');
        }

        $_item = $this->findMenuItem('Posts');
        if ($_item->exists) {
            $this->trans('de', $this->arr($_tpl, $_item->id), 'Beiträge');
        }

        $_item = $this->findMenuItem('Users');
        if ($_item->exists) {
            $this->trans('de', $this->arr($_tpl, $_item->id), 'Users');
        }

        $_item = $this->findMenuItem('Categories');
        if ($_item->exists) {
            $this->trans('de', $this->arr($_tpl, $_item->id), 'Kategorien');
        }

        $_item = $this->findMenuItem('Pages');
        if ($_item->exists) {
            $this->trans('de', $this->arr($_tpl, $_item->id), 'Seiten');
        }

        $_item = $this->findMenuItem('Roles');
        if ($_item->exists) {
            $this->trans('de', $this->arr($_tpl, $_item->id), 'Rollen');
        }

        $_item = $this->findMenuItem('Tools');
        if ($_item->exists) {
            $this->trans('de', $this->arr($_tpl, $_item->id), 'Tools');
        }

        $_item = $this->findMenuItem('Menu Builder');
        if ($_item->exists) {
            $this->trans('de', $this->arr($_tpl, $_item->id), 'Menü');
        }

        $_item = $this->findMenuItem('Database');
        if ($_item->exists) {
            $this->trans('de', $this->arr($_tpl, $_item->id), 'Datenbank');
        }

        $_item = $this->findMenuItem('Settings');
        if ($_item->exists) {
            $this->trans('de', $this->arr($_tpl, $_item->id), 'Einstellungen');
        }
    }

    private function findMenuItem($title)
    {
        return MenuItem::where('title', $title)->firstOrFail();
    }

    private function arr($par, $id)
    {
        return [
            'table_name'  => $par[0],
            'column_name' => $par[1],
            'foreign_key' => $id,
        ];
    }

    private function trans($lang, $keys, $value)
    {
        $_t = Translation::firstOrNew(array_merge($keys, [
            'locale' => $lang,
        ]));

        if (!$_t->exists) {
            $_t->fill(array_merge(
                $keys,
                ['value' => $value]
            ))->save();
        }
    }
}
