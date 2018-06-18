<?php

namespace App\Models;

use App\Components\TextHelper;
use App\Components\Config;

class User extends Model
{
    protected $username;
    protected $password;
    protected $role;
    protected $name;

    public function getName()
    {
        return $this->name;
    }
}
