<?php
session_start();
require_once("C:xampp/htdocs/php tasks/phpfinal/php-project/vendor/autoload.php");

use App\Controllers\OrderController;
use App\Controllers\ProductController;

$order_cont = new OrderController();
$product_cont = new ProductController();
if (isset($_SESSION['user_id'])) {
    if (isset($_GET['download_link'])) {
        $product_id = $product_cont->retrieve_product_id($_GET['download_link']);
        $download_count = $order_cont->retrieve_count($_SESSION['user_id'], $product_id);
        if ($download_count < 7) {
            $file = 'book.txt';

            if (!file_exists($file)) { // file does not exist
                die('file not found');
            } else {
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$file");
                header("Content-Type: txt/html");


                // read the file from disk
                readfile($file);
                $order_cont->increment_count($_SESSION['user_id'], $product_id);
                $product_cont->change_download_link($product_id);
                header("Location:product.php");
                die;
            }
        } else echo "you exceeded your download limit";
    } else echo "wrong download link";
} else {
     header("Location:login.php");
     die;
}
