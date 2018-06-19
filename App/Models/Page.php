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

    private function getDataAll()
    {
        return $__pages = glob(DATA_DIR . '/pages/*');
    }

    public function all(int $id = 0)
    {
        $__pages = glob(DATA_DIR . '/pages/*');
        $total = count($__pages);

        if ($total) {

            rsort($__pages);

            foreach ($__pages as $page) {
                $i = pathinfo($page);
                $__page = $this->database->get($i['filename'], 'pages');
                $__page = array_merge($__page, ['id' => $i['filename']]);

                if ((int)$i['filename'] === (int)$id) {
                    return new Page($__page);
                }

                $pages[] = new Page($__page);
            }
        }

        return $pages;
    }

    public function find(int $id)
    {
        return $this->all($id);
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
