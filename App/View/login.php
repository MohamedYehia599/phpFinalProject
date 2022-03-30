<?php

use App\Controllers\UserController;
use App\Model\User;
use App\Controllers\TokenController;

session_start();
require_once("C:xampp/htdocs/php tasks/phpfinal/php-project/vendor/autoload.php");
$user_obj = new User();
$User_cont = new UserController();
$token_cont = new TokenController();
// echo $_SERVER['REQUEST_METHOD'];
if (isset($_POST['email']) && isset($_POST['password'])) {
    
    $id = $user_obj->login($_POST['email'], $_POST['password']);
    if (is_numeric($id) && $id >= 0) {
        $_SESSION['user_id'] = $id;
           header("Location:product.php");
           die;
    } else {
        $error = "wrong user name or password";
        
    }
    
    if (isset($_SESSION['user_id']) && isset($_POST['remember_me']) && !isset($_COOKIE['remember_me']) && $_POST['remember_me'] == true) {
         
        $token_cont->store($id);
    }

 
}

if (isset($_COOKIE['remember_me']) && !isset($_SESSION['user_id'])) {

    $id = $token_cont->check_token($_COOKIE['remember_me']);
    if ($id > 0) {
        
        $_SESSION['user_id'] = $id;
        header("Location:product.php");
        die;
    }
}



 include "partials/head.html";
 include "partials/header.html";
?>

<html>

<body>

<div class="py-5 container">
  <div class="d-flex">
    <div class="col-lg-6 col-md-10 col-12 mx-auto">
      <form action="" method="POST" class="d-flex flex-column">
        <div class="form-group mb-3">
          <label for="email" class="form-label">Email</label>
          <input name="email" id="email" placeholder="example@domain.com" type="email" class="form-control">
        </div>
        <div class="form-group mb-3">
          <label for="password" class="form-label">Password</label>
          <input name="password" id="password" placeholder="***" type="password" class="form-control">
          <?php if (isset($error)){echo '<span style="color:red; font-size: small">'.$error.'</span>';}?>
        </div>
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" name="remember_me" >
          <label class="form-check-label" for="remember_me">
            remember me
          </label>
        </div>
        <button class="btn btn-primary mx-auto mb-3">Login</button>
        <p class="text-center">Don't have an account? <a href="http://localhost/php%20tasks/phpfinal/php-project/App/View/register.php">Create a new account</a></p>
      </form>
    </div>
  </div>
</div>




</body>



</html>