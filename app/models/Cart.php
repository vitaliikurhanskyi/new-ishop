<?php


namespace app\models;


use RedBeanPHP\R;

class Cart extends AppModel
{

    public function get_product($id, $lang): array
    {
        return R::getRow("SELECT p.*, pd.* FROM product p JOIN product_description pd ON p.id = pd.product_id WHERE p.status = 1 AND p.id = ? AND pd.language_id = ?", [$id, $lang['id']]);
    }

    public function add_to_cart($product, $quantity = 1)
    {
        $quantity = abs($quantity);

        if($product['is_download'] && isset($_SESSION['cart'][$product['id']])) {
            return false;
        }

        if(isset($_SESSION['cart'][$product['id']])) {
            $_SESSION['cart'][$product['id']]['quantity'] += $quantity;
        } else {
            if($product['is_download']) {
                $quantity = 1;
            }
            $_SESSION['cart'][$product['id']] = [
                'title' => $product['title'],
                'slug' => $product['slug'],
                'price' => $product['price'],
                'quantity' => $quantity,
                'img' => $product['img'],
                'is_download' => $product['is_download']
            ];
        }

        $_SESSION['cart.quantity'] = !empty($_SESSION['cart.quantity']) ? $_SESSION['cart.quantity'] + $quantity : $quantity;
        $_SESSION['cart.sum'] = !empty($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $quantity * $product['price'] : $quantity * $product['price'];

        return true;

    }

}