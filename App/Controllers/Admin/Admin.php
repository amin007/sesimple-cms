<?php

namespace App\Controllers\Admin;

// controllers
use App\Controllers\Controller;

// components
use App\Components\UrlHelper;
use App\Components\TextHelper;
use App\Components\Auth;
use App\Components\Database;

// models
use App\Models\User;

class Admin extends Controller
{
    protected $database;

    public function __construct()
    {
        parent::__construct();
        $this->database = new Database;
    }

    public function index()
    {
        $pages = [];
        $__pages = glob(DATA_DIR . '/pages/*');
        $total = count($pages);

        rsort($__pages);

        foreach ($__pages as $page) {
            $i = pathinfo($page);
            $__page = $this->database->get($i['filename'], 'pages');
            $__page = array_merge($__page, ['id' => $i['filename']]);
            $pages[] = $__page;
        }

        echo $this->view->render('admin/home', [
            'self' => $this,
            'pages' => $pages,
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

    public function addPage()
    {
        $pageId = (!empty($_GET['page_id']) ? $_GET['page_id'] : null);
        $pageData = [];

        if ($pageId) {
            if ($pageData = $this->database->get($pageId, 'pages')) {
                $pageData = array_merge($pageData, [
                    'id' => $pageId
                ]);
            }
        }
        echo $this->view->render('admin/pages/add', [
            'pageData' => $pageData
        ], true);
    }

    public function doAddPage()
    {
        $actionRemove = (!empty($_GET['action']) && $_GET['action'] === 'remove' ? true : false);

        if (!$pageId = (!empty($_GET['page_id']) ? $_GET['page_id'] : null)) {
            $pageId = (!empty($_POST['page_id']) ? $_POST['page_id'] : null);
        }

        $title = (!empty($_POST['title']) ? $_POST['title'] : null);
        $body = (!empty($_POST['body']) ? $_POST['body'] : null);

        if ($actionRemove && $pageId) {
            $this->database->remove($pageId, 'pages');
            UrlHelper::redirect("/admin", [
                'message' => 'Page deleted!'
            ]);
        }

        if (!$pageId) {
            $pages = glob(DATA_DIR . '/pages/*');
            $lastPage = end($pages);
            $lastPage = pathinfo($lastPage);
            $total = count($pages);
            $pageId = $lastPage['filename'] ? (int)$lastPage['filename'] + 1 : 1;
        }

        $this->database->set($pageId, [
            'title' => $title,
            'body' => $body
        ], false, 'pages');

        UrlHelper::redirect("/admin/pages/add?page_id={$pageId}", [
            'message' => 'Page created!'
        ]);
    }
}
