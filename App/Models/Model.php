<?php

namespace App\Models;

use App\Components\Cache;
use App\Components\Config;
use App\Components\TextHelper;
use App\Components\Database;

class Model
{
    protected $slugify;
    protected $__raw_data;
    protected $cache;
    protected $config;
    protected $database;

    public function __construct($raw_data = [])
    {
        $this->cache = new Cache();
        $this->config = new Config();
        $this->database = new Database();
        $this->__raw_data = $raw_data;

        if ($raw_data) {
            foreach ($raw_data as $property => $value) {

                if (property_exists($this, $property)) {
                    $this->$property = $value;
                }
            }
        }
    }

    public function get_raw_data()
    {
        return $this->__raw_data;
    }

    public function get_data()
    {
        $array = [];
        foreach (get_object_vars($this) as $key => $value) {
            if ($key !== '__raw_data') {
                $array[$key] = $value;
            }
        }

        return $array;
    }
}
