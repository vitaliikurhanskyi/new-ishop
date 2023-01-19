<?php


namespace app\controllers;

use core\App;

/** @property Cart $model */

class CartController extends AppController
{

    public function addAction(): bool
    {
        $lang = App::$app->getProperty('language');
        $id = get('id');
        $quantity = get('quantity');

        if(!$id) {
            return false;
        }

        $product = $this->model->get_product($id, $lang);

        if(!$product) {
            return false;
        }

        $this->model->add_to_cart($product, $quantity);

        if($this->isAjax()) {
            dd($_SESSION['cart'], 1);
        }

        redirect();
        return true;

    }

}