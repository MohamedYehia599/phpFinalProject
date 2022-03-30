<?php

namespace App\Controllers;

use App\Model\Order;

class OrderController
{
    public Order $order;
    function __construct()
    {
        $this->order = new Order();
    }

    public function make_order($user_id, $product_id)
    {
        $this->order->create_order($user_id, $product_id);
    }
    public function retrieve_count($user_id, $product_id)
    {
        return $this->order->get_count($user_id, $product_id);
    }
    public function increment_count($user_id, $product_id){
        $this->order->update_count($user_id, $product_id);
    }
}
