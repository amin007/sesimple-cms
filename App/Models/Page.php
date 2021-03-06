<?php

namespace App\Models;

// components
use App\Components\TextHelper;
use App\Components\Config;

class Page extends Model
{
    protected $id;
    protected $title;
    protected $slug;
    protected $body;

    public function all()
    {
        if (file_exists(DATA_DIR . '/pages')) {
            $__pages = glob(DATA_DIR . '/pages/*');
            $total = count($__pages);

            if ($total) {

                rsort($__pages);

                foreach ($__pages as $page) {
                    $i = pathinfo($page);
                    $__page = $this->database->get($i['filename'], 'pages');
                    $__page = array_merge($__page, ['id' => $i['filename']]);
                    $pages[] = new Page($__page);
                }
            }

            return $pages;
        }

        return [];
    }

    public function find($id)
    {
        if ($page = $this->database->get($id, 'pages')) {
            return new Page($page);
        }

        return null;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getSlug()
    {
        return $this->slug ?: TextHelper::slugify($this->getTitle());
    }

    public function getBody($html = false)
    {
        if (!$this->body) {
            return null;
        }

        return $html ? TextHelper::markdownToHtml($this->body) : $this->body;
    }

    public function getId()
    {
        return (int)$this->id;
    }

    public function getUrl()
    {
        if (!$this->getId()) {
            return null;
        }

        return "/page/{$this->getSlug()}/{$this->getId()}";
    }

    public function getEditUrl()
    {
        if (!$this->getId()) {
            return null;
        }
        return "/admin/pages/add/?page_id={$this->getId()}";
    }
}
