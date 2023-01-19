<?php


namespace app\controllers;

use core\App;

/** @property Cart $model */

class CartController extends AppController
{

    public function addAction()
    {
        $lang = App::$app->getProperty('language');
        $id = get('id');
        $quantity = get('quantity');

        if(!$id) {
            return false;
        }

        $product = $this->model->get_product($id, $lang);

        dd($product, 1);

    }

}