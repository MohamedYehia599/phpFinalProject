<?php

namespace App\Model;

use Illuminate\Database\capsule\Manager as Capsule;

class DB
{

    public function __construct()
    {
        $this->capsule = new Capsule();
        $this->capsule->addConnection([
            "driver" => _driver_,
            "host" => _host_,
            "database" => _database_,
            "username" => _username_,
            "password" => _password_
        ]);
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }
}
