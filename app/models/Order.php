<?php


namespace app\models;


use RedBeanPHP\R;

class Order extends AppModel
{

    public static function saveOrder($data): int|false
    {
        R::begin();
        try {
//            dd($data);
//            dd($_SESSION, 1);
            $order = R::dispense('orders');
            $order->user_id = $data['user_id'];
            $order->note = $data['note'];
            $order->total = $_SESSION['cart.sum'];
            $order->qty = $_SESSION['cart.quantity'];
            $order_id = R::store($order);

            R::commit();
            return $order_id;
        } catch (\Exception $e) {
            R::rollback();
            return false;
        }
    }

}