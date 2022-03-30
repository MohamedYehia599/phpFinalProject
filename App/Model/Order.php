<?php

namespace App\Model;

use Illuminate\Database\capsule\Manager as Capsule;

class Order
{
    public DB $DB;
    function __construct()
    {
        $this->DB = new Db();
    }
    public function get_count($user_id, $product_id)
    {

        $order = Capsule::table('orders')->where('user_id', $user_id)->where('product_id', $product_id)->first();
        return $order->download_count;
    }
    public function create_order($user_id, $product_id)
    {

        Capsule::table('orders')->insert([
            "user_id" => $user_id,
            "product_id" => $product_id
        ]);
    }
    public function update_count($user_id, $product_id)
    {

        $download_count = $this->get_count($user_id, $product_id);
        Capsule::table('orders')->where('user_id', $user_id)->where('product_id', $product_id)->update(['download_count' => ++$download_count]);
    }
}
