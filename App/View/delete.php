<?php

use App\Controllers\UserController;

session_start();
require_once("C:xampp/htdocs/php tasks/phpfinal/php-project/vendor/autoload.php");
$User_cont = new UserController();
$User_cont->destroy($_SESSION['user_id']);
header("Location:login.php");
