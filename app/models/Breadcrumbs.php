<?php


namespace app\models;


use core\App;

class Breadcrumbs extends AppModel
{

    public static function getBreadcrumbs($category_id, $name = ''): string
    {
        $lang = App::$app->getProperty('language')['code'];
        $categories = App::$app->getProperty("categories_{$lang}");
        $breadcrumbs_array = self::getParts($categories, $category_id);
        //dd($breadcrumbs_array, 1);
        $breadcrumbs = "<li class='breadcrumb-item'><a href='" . base_url() . "'>" . ___('tpl_home_breadcrumbs') . "</a></li>";
        if ($breadcrumbs_array) {
            foreach ($breadcrumbs_array as $slug => $title) {
                $breadcrumbs .= "<li class='breadcrumb-item'><a href='category/{$slug}'>{$title}</a></li>";
            }
        }
        if ($name) {
            $breadcrumbs .= "<li class='breadcrumb-item active'>$name</li>";
        }
        return $breadcrumbs;
    }

    public static function getParts($categories, $category_id): array|false
    {
        if (!$category_id) {
            return false;
        }
        $breadcrumbs = [];
        foreach ($categories as $k => $v) {
            if (isset($categories[$category_id])) {
                $breadcrumbs[$categories[$category_id]['slug']] = $categories[$category_id]['title'];
                $category_id = $categories[$category_id]['parent_id'];
            } else {
                break;
            }
        }
        return array_reverse($breadcrumbs, true);
    }

}