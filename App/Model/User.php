<?php

namespace App\Model;

use App\Model\DB;
use Exception;
use Illuminate\Database\capsule\Manager as Capsule;

class User implements UserTest
{
    private $id;
    private $email;
    private $password;
    private $token;
    // public DB $DB;

    public function set_id($user_id)
    {
        $this->id = $user_id;
    }
    public function get_id()
    {
        return $this->id;
    }
    public function set_email($user_email)
    {
        $this->email = $user_email;
    }
    public function get_email()
    {
        return $this->email;
    }
    public function set_password($user_password)
    {
        $this->password = $user_password;
    }
    public function get_password()
    {
        return $this->password;
    }
    public function set_token($user_token)
    {
        $this->token = $user_token;
    }
    public function get_token()
    {
        return $this->token;
    }

    function __construct()
    {

        $DB = new DB;
    }
    public function login($email, $password)
    {
        try{
        $user =   Capsule::table('users')->where('Email', $email)->first();
        if($user != null){
        if ($user->Email === $email && $user->password === $password) {

            return $user->id;
        } else return -1;
    }else return -1;
    } 
    catch(Exception $e){
        echo $e->getMessage();
    }
    }
    public function getdata($id)
    {
        $user = Capsule::table('users')->find($id);
        return $user;
    }
    public function register()
    {
        Capsule::table('users')->insert([
            'Email' => $this->get_email(),
            'password' => $this->get_password()

        ]);
    }
    public function update($id)
    {
        Capsule::table('users')->where('id', $id)->update(['Email' => $this->get_email(), 'password' => $this->get_password()]);
    }
    public function delete($id)
    {

        Capsule::table('users')->where('id', $id)->delete();
    }
}
