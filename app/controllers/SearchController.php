<?php


namespace app\controllers;


use app\models\Search;
use core\App;
use core\Pagination;

/** @property Search $model */
class SearchController extends AppController
{

    public function indexAction()
    {
        $search = get('search', 's');
        $lang = App::$app->getProperty('language');
        $page = get('page');
        $perpage = App::$app->getProperty('pagination');
        $total = $this->model->get_count_search_products($search, $lang);
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $products = $this->model->get_search_products($search, $lang, $start, $perpage);

        $this->setMeta(___('tpl_search_title'));
        $this->set(compact('search', 'products', 'pagination', 'total'));
    }

}