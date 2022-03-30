<?php

use App\Controllers\OrderController;
use App\Controllers\ProductController;

session_start();
require_once("C:xampp/htdocs/php tasks/phpfinal/php-project/vendor/autoload.php");
$order_cont = new OrderController();
$product_cont = new ProductController();
if (isset($_SESSION['user_id'])) {
    if (isset($_GET['product_id'])) {
        // echo $_GET['product_id'];

        $download_count = $order_cont->retrieve_count($_SESSION['user_id'], $_GET['product_id']);
        $download_link = $product_cont->retrieve_download_link($_GET['product_id']);
    } else {
        header("Location:product.php?product_id=2");
        die;
    }
} else {
    header("Location:login.php");
    die;
}

include "partials/head.html";
include "partials/header.html";

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript">
        window.addEventListener('load', function() {
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })

        })
    </script>
</head>

<body>
    <style media="screen">
        .box1 {
            padding: 5px;
            width: 60vw;
            height: 65vh;
            display: grid;
            grid-template-columns: 40vw 16px 1fr;
            grid-template-rows: 40vh 20vh;
            gap: 10px;
            border: 2px solid black;
            margin: 10px;
            overflow-y: auto;
        }


        .image {

            background-position: center;
            grid-column: 1/2;

        }

        .describtion {
            /* border:1px solid black; */
            grid-column: 1/3;
            grid-row: 2/3;
            overflow-y: auto;
            margin-left: 10px;
        }

        .more {
            grid-column: 2/3;
            grid-row: 1/2;
        }

        .more:hover {}

        .download {
            display: flex;
            grid-row: 1/3;
            grid-column: 3/4;
            flex-direction: column;
            justify-content: center;
            margin-left: 40px;
        }

        a {
            margin-bottom: 20px;
        }

        img {
            height: 100%;
            width: 100%;
            object-fit: contain;
        }
    </style>
    <div class="container">
        <div class="box1">
            <div class="image">
                <img src="book.png" alt="book image">
            </div>
            <div class="describtion">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.

            </div>
            <div class="more">
                <img src="more.png" data-bs-toggle="popover" title="book-describtion" data-bs-content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. " alt="">
            </div>
            <div class="download">
                <a class="btn btn-outline-success" type="button" name="button" href="download.php?download_link=<?php echo $download_link; ?>">download</a>
                <p><?php echo "download count = " . $download_count;   ?></p>

            </div>
        </div>
    </div>
</body>

</html>