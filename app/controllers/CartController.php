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
            $this->loadView('cart_modal');
        }

        redirect();
        return true;

    }

    public function showAction()
    {
        $this->loadView('cart_modal');
    }

    public function deleteAction()
    {

        $id = get('id');
        if(isset($_SESSION['cart'][$id])) {
            $this->model->delete_item($id);
        }
        if($this->isAjax()) {
            $this->loadView('cart_modal');
        }
        redirect();
    }

    public function clearAction()
    {
        if(empty($_SESSION['cart'])) {
            return false;
        }
        unset($_SESSION['cart']);
        unset($_SESSION['cart.quantity']);
        unset($_SESSION['cart.sum']);
        if($this->isAjax()) {
            $this->loadView('cart_modal');
            return true;
        }
    }

}