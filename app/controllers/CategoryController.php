<?php


namespace app\controllers;

use app\models\Breadcrumbs;
use app\models\Category;
use core\App;
use core\Pagination;


/** @property Category $model */

class CategoryController extends AppController
{
    public function viewAction()
    {
        $lang = App::$app->getProperty('language');

        $category = $this->model->get_category($this->route['slug'], $lang);

        //dd($category, 1);

        //dd($category['id'], 1);

        if(!$category) {
            $this->error_404();
            return;
        }

        $breadcrumbs = Breadcrumbs::getBreadcrumbs($category['id']);
//        $cats = App::$app->getProperty("categories_{$lang['code']}");
//        dd($cats);

        $ids = $this->model->get_ids($category['id']);

        // add current category
        $ids = !$ids ? $category['id'] : $ids . $category['id'];

        // http://new-ishop.loc/en/category/noutbuki
        //dd($ids, 1);

        //$page = abs(get('page')) ? get('page') : 1;
        //$page = abs(get('page')) ?: 1;
        $page = abs(get('page'));
        $perpage = App::$app->getProperty('pagination');
        $total = $this->model->get_count_products($ids);

        //var_dump($page, $perpage, $total);

        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $products = $this->model->get_categories_products($ids, $lang['id'], $start, $perpage);
        //dd($products, 1);
        $this->setMeta($category['title'], $category['description'], $category['keywords']);
        $this->set(compact('products', 'breadcrumbs', 'category', 'total', 'pagination'));
    }
}