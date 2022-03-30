<?php

namespace App\Controllers;

use App\Model\Token;
use App\Model\User;
use App\Controllers\OrderController;
// $db = new DB();



class UserController implements Controller
{



    public function show($id)
    {
        // //to get record entered from database
        // $user =   Capsule::table('users')->where('Email', $email)->first();
        // //check if entered data is correct
        // if ($user->Email === $email && $user->password === $password) {
        //     return true;
        //     //should redirect the user to his home page
        // } else return false;
        // return Capsule::table('users');


        if (is_numeric($id)) {
            if (isset($_SESSION['user_id'])) {
                $user_obj = new User();
                $data = $user_obj->getdata($id);
                // put data in session  
                return $user_obj->getdata($id);
            }
        }
    }
    public function store()
    {
        $user = new User();
        $order_cont = new OrderController;
        $user->set_email($_POST['email']);
        $user->set_password($_POST['password']);
        $user->register();
        $_SESSION['user_id'] = $user->login($_POST['email'], $_POST['password']);
        $order_cont->make_order($_SESSION['user_id'], 2);
        header("Location:product.php?product_id=2");
    }

    public function update($id)
    {
        $user = new User();
        $user->set_email($_POST['email']);
        $user->set_password($_POST['password']);
        $user->update($id);
    }
    public function destroy($id)
    {
        if (isset($_COOKIE['remember_me'])) {
            setcookie("remember_me", "", time() - 3600000, "/");
        }
        $token = new Token();
        $token->delete_user_tokens($id);
        $user = new User();
        $user->delete($id);
        session_unset();
        session_destroy();
        header("Location:login.php");
    }
    public function logout()
    {
        if (isset($_COOKIE['remember_me'])) {
            $token = new Token();
            $token->delete_token($_COOKIE['remember_me']);
            setcookie("remember_me", "", time() - 3600000, "/");
        }
        session_unset();
        session_destroy();

        header("Location:login.php");
    }
}
