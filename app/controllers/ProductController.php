<?php

namespace app\controllers;


use app\models\Breadcrumbs;
use core\App;

/** @property Product $model $model */
class ProductController extends AppController {

	public function viewAction()
    {
		$lang = App::$app->getProperty('language');
        $slug = $this->route['slug'];
		$product = $this->model->get_product($slug, $lang);
		//dd($product, 1);
        if(empty($product)) {
            throw new \Exception("Product {$slug} not found", 404);
        }

        $breadcrumbs = Breadcrumbs::getBreadcrumbs($product['category_id'], $product['title']);

        $gallery = $this->model->get_gallery($product['id']);

        $this->setMeta($product['title'], $product['description'], $product['keywords']);

        $this->set(compact('product', 'gallery'));

        //dd($product, 1);
	}

}