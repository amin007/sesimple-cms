<?php

namespace App\Routes\Admin;

// controllers
use App\Controllers\Admin\Admin as AdminController;

// routes
use App\Routes\Web;

class Admin extends Web
{
    public function __construct()
    {
        $route = parent::__construct();

        /**
         * Register Routes
         */
        switch (true) {

            case $this->isRoute('/admin'):
                $controller = new AdminController();
                $controller->index();
                break;

            case $this->isRoute('/admin/login'):

                if (!empty($_POST['csrf']) && hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
                    $controller = new AdminController();
                    $controller->doLogin($_POST['username'], $_POST['password']);
                    break;
                }

                $controller = new AdminController();
                $controller->login();
                break;

            case $this->isRoute('/admin/logout'):
                $controller = new AdminController();
                $controller->logout();
                break;

            default:
                header('HTTP/1.0 404 Not Found');
                break;
        }

        return $route;
    }
}
