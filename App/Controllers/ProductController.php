<?php

namespace App\Controllers;

use App\Model\Product;
use App\Controllers\TokenController;

class ProductController
{

    public Product $product;

    function __construct()
    {
        $this->product = new Product();
    }
    public function change_download_link($product_id)
    {
        $token_cont = new TokenController();
        $new_link = $token_cont->generateNewCookie();
        $this->product->update_link($product_id, $new_link);
    }
    public function retrieve_download_link($product_id)
    {
        return $this->product->get_link($product_id);
    }
    public function retrieve_product_id($link){
       return $this->product->get_id($link);
    }
}
