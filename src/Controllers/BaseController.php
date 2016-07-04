<?php

namespace App\Controllers;

use Spot\Locator as DB;
use Psr\Log\LoggerInterface as Logger;

class BaseController
{
    protected $db;
    protected $logger;

    public function __construct(DB $db, Logger $logger)
    {
        $this->db = $db;
        $this->logger = $logger;
    }
}
