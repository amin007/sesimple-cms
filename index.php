<?php

ini_set('memory_limit', -1);
date_default_timezone_set('Asia/Kuala_Lumpur');

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/constants.php';

use App\Routes\Web as WebRoute;
use App\Routes\Admin\Admin as WebAdminRoute;
use App\Components\UrlHelper;

class App
{
    public function __construct()
    {
        session_start();

        if (!isset($_SESSION['csrf'])) {
            $token = md5(uniqid(rand(), true));
            $_SESSION['csrf'] = $token;
            $_SESSION['csrf_time'] = time();
        } else {
            $token = $_SESSION['csrf'];
        }

        // new WebRoute;
        new WebAdminRoute;

        // reset flash session
        UrlHelper::removeFlashSession();
    }
}

new App;
