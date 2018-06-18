<?php

namespace App\Components;

use App\Components\TextHelper;
use App\Components\Cache;

class Database extends Cache
{
    public function __construct()
    {
        parent::__construct(DATA_DIR);
    }
}
