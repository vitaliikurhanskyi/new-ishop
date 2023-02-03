<?php


namespace app\controllers;

use app\models\User;
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

    public function viewAction()
    {
        $this->setMeta(___('tpl_cart_title'));
    }

    public function checkoutAction()
    {
        if(!empty($_POST)) {
            //регистрация пользователя если не авторизован
            if(!User::checkAuth()) {
                $user = new User();
                $data = $_POST;
                $user->load($data);
                if(!$user->validate($data) || !$user->checkUnique()) {
                    $user->getErrors();
                    $_SESSION['form_data'] = $data;
                    redirect();
                } else {
                    $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                    if (!$user_id = $user->save('user')) {
                        $_SESSION['errors'] = ___('cart_checkout_error_save_order');
                        redirect();
                    }
                }
            }
        }
        redirect();
    }

}