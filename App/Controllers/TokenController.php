<?php

namespace App\Controllers;

use App\Model\Token;

class TokenController
{
    public Token $token_obj;
    public function __construct()
    {
        $this->token_obj = new Token();
    }
    function generateNewCookie($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        setcookie('remember_me', $randomString, time() + 60 * 60 * 24 * 30, "/");
        return $randomString;
    }

    public function store($id)
    {
        $token = $this->generateNewCookie(20);
        $this->token_obj->add_token($id, $token);
    }
    public function check_token($token)
    {
        //dlw2ty na 3ndy token w da5l 3la l login 
        //token = 1111
        //3ndy 2 cases awln en ltoken tb2a 3ndy f3ln fl database w sa3et.ha eshta h return l record w ldnya foll
        
        $token_record = $this->token_obj->search_by_token($token);
        if ($token_record && $token_record->isused==true) {
            $token_id = $token_record->id;
            $user_id = $token_record->user_id;
            $new_token = $this->generateNewCookie(20);
            $this->token_obj->update_valid_token($token_id, $new_token);
            return $user_id;
        } else return -1;
    }
}
