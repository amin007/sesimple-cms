<?php

namespace App\Controllers\Admin;

// controllers
use App\Controllers\Controller;

// components
use App\Components\UrlHelper;
use App\Components\TextHelper;
use App\Components\Auth;

// models
use App\Models\User;

class Admin extends Controller
{
    public function __construct()
    {
        return parent::__construct();
    }

    public function index()
    {
        echo $this->view->render('admin/home', [
            'self' => $this
        ], true);
    }

    public function login()
    {
        if (Auth::isAuth()) {
            UrlHelper::redirect('/admin');
        }
        echo $this->view->render('admin/login', [], true);
    }

    public function doLogin()
    {
        $username = (!empty($_POST['username']) && !preg_match('/\s/', $_POST['username']) ? $_POST['username'] : null);
        $password = (!empty($_POST['password']) ? $_POST['password'] : null);

        if (isset($this->config['cms']['users'][$username]) && ($this->config['cms']['users'][$username]['password'] === $password)) {
            $_SESSION['logged_in_user'] = [
                'username' => $username
            ];
            UrlHelper::redirect('/admin');
        }

        UrlHelper::redirect('/admin/login', [
            'messageError' => 'Username not exist or password is not correct.'
        ]);
    }

    public function logout()
    {
        if (Auth::isAuth()) {
            unset($_SESSION['logged_in_user']);
            unset($_SESSION['csrf']);

            UrlHelper::redirect('/admin/login', [
                'message' => 'You\'ve logged out.'
            ]);
        }

        UrlHelper::redirect('/admin/login');
    }
}
