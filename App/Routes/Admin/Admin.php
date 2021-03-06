<?php

namespace App\Routes\Admin;

// controllers
use App\Controllers\Admin\Admin as AdminController;

// routes
use App\Routes\Web;

// components
use App\Components\Auth;
use App\Components\UrlHelper;

class Admin extends Web
{
    public function __construct()
    {
        if ($this->isRoute('/admin', true)) {

            /**
             * Register Routes
             */
             switch (true) {

                 case $this->isRoute('/admin'):

                     if (!Auth::isAuth()) {
                         UrlHelper::redirect('/admin/login');
                     }

                     $controller = new AdminController();
                     $controller->index();
                     break;

                 case $this->isRoute('/admin/login'):

                     if (!empty($_POST['csrf']) && hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
                         $controller = new AdminController();
                         $controller->doLogin();
                         break;
                     }

                     $controller = new AdminController();
                     $controller->login();
                     break;

                 case $this->isRoute('/admin/logout'):
                     $controller = new AdminController();
                     $controller->logout();
                     break;

                 case $this->isRoute('/admin/pages/add'):

                     if (@$_GET['action'] === 'remove' && @$_GET['page_id']) {
                         $controller = new AdminController();
                         $controller->doAddPage();
                         break;
                     }

                     if (!empty($_POST['csrf']) && hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
                         $controller = new AdminController();
                         $controller->doAddPage();
                         break;
                     }

                     $controller = new AdminController();
                     $controller->addPage();
                     break;
             }
             
        } else {
            parent::__construct();
        }
    }
}
