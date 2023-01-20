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

        if (isset($_SESSION['cart'][$product['id']])) {
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

    public function delete_item($id)
    {
        $quantity_minus = $_SESSION['cart'][$id]['quantity'];
        $sum_minus = $_SESSION['cart'][$id]['quantity'] * $_SESSION['cart'][$id]['price'];
        $_SESSION['cart.quantity'] -= $quantity_minus;
        $_SESSION['cart.sum'] -= $sum_minus;
        unset($_SESSION['cart'][$id]);
    }

    public static function translate_cart($lang)
    {
        if(empty($_SESSION['cart'])) {
            return;
        }
        $product_id_s = implode(',', array_keys($_SESSION['cart']));
        $products = R::getAll("SELECT p.id, pd.title FROM product p JOIN product_description pd ON p.id = pd.product_id WHERE p.id IN ($product_id_s) AND pd.language_id = ?", [$lang['id']]);

        foreach ($products as $product){
            $_SESSION['cart'][$product['id']]['title'] = $product['title'];
        }
    }

}