<?php


namespace app\controllers;

use app\models\Wishlist;

/** @property Wishlist $model */
class WishlistController extends AppController
{
    public function addAction()
    {
        $id = get('id');
        if(!$id) {
            $answer = [
                'result' => 'error',
                'text' => ___('tpl_wishlist_add_error'),
            ];
            exit(json_encode($answer));
        }

        $product = $this->model->get_product($id);
        if($product) {
            $answer = [
                'result' => 'success',
                'text' => ___('tpl_wishlist_add_success'),
            ];
        } else {
            $answer = [
                'result' => 'error',
                'text' => ___('tpl_wishlist_add_error'),
            ];
        }
        exit(json_encode($answer));

    }
}