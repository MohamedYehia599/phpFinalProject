<?php

namespace App\Model;

use Illuminate\Database\capsule\Manager as Capsule;

class Token
{
    public DB $DB;
    public function __construct()
    {
        $this->DB = new DB();
    }

    public function add_token($id, $token)
    {

        Capsule::table('tokens')->insert([
            'user_id' => $id,
            'remeber_me_token' => $token,
            'isused' => false

        ]);
    }
    public function search_by_token($token)
    {
        $token_record =  Capsule::table('tokens')->where('remeber_me_token', $token)->first();
        if ($token_record) {
            $id = $token_record->id;

            Capsule::table('tokens')->where('id', $id)->update(['isused' => true]);
            $updated_token = Capsule::table('tokens')->where('id', $id)->first();
            return $updated_token;
        } else {
            return null;
        }
    }
    public function update_valid_token($token_id, $new_token)
    {
        Capsule::table('tokens')->where('id', $token_id)->update(['isused' => false, 'remeber_me_token' => $new_token]);
    }
    public function delete_token($token)
    {
        Capsule::table('tokens')->where('remeber_me_token', $token)->delete();
    }
    public function delete_user_tokens($user_id)
    {
        Capsule::table('tokens')->where('user_id', $user_id)->delete();
    }
}
