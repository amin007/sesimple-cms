<?php

namespace App\Controllers;

// components
use App\Components\UrlHelper;
use App\Components\TextHelper;

// models
use App\Models\Page;

class Site extends Controller
{
    public function index()
    {
        $messages = [
            'Hello and thank you for using <a href="https://github.com/syaifulsz/sesimple-framework">Sesimple Framework</a>.',
            '<i>Sesimple yang boleh.</i>',
            'See example of static page <a href="/about-sesimple-framework">About Sesimple Framework</a>'
        ];

        $page = new Page;

        echo $this->view->render('home', [
            'messages' => $messages,
            'pages' => $page->all()
        ], true);
    }

    public function page($id)
    {
        $page = new Page;

        echo $this->view->render('page', [
            'page' => $page->find($id)
        ], true);
    }

    public function staticPage($page)
    {
        return $this->view->render($page);
    }
}
