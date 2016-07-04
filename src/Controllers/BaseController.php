<?php

namespace App\Controllers;

use Spot\Locator as DB;
use Psr\Log\LoggerInterface as Logger;

class BaseController
{
    protected $db;
    protected $logger;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }
}
