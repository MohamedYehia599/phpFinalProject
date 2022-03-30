<?php

namespace App\Model;

use Illuminate\Database\capsule\Manager as Capsule;

class Product
{
    public DB $DB;

    function __construct()
    {
        $this->DB = new DB();
    }
    public function update_link($product_id, $new_link)
    {
        Capsule::table('products')->where('id', $product_id)->update(['download_file_link' => $new_link]);
    }
    public function get_link($product_id)
    {
        $product =    Capsule::table('products')->where('id', $product_id)->first();
        return $product->download_file_link;
    }
    public function get_id($link){
        $product =    Capsule::table('products')->where('download_file_link', $link)->first();
        return $product->id;
    }
}
