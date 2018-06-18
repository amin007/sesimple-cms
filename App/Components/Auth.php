<?php

namespace App\Components;

// components
use App\Components\Config;

// models
use App\Models\User;

class Auth
{
    public static function isAuth()
    {
        return self::getAuthUser() ? true : false;
    }

    public static function getAuthUser()
    {
        $config = new Config;
        if (!empty($_SESSION['logged_in_user'])) {
            $user = $config->get('cms')['users'][$_SESSION['logged_in_user']['username']];
            return new User($user);
        }

        return false;
    }
}
