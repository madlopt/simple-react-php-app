<?php

declare(strict_types=1);

namespace PhpSimpleApp\Model;

use PhpSimpleApp\Config\Config;
use PhpSimpleApp\Controller\LogLoopController;
use PhpSimpleApp\Controller\ServerController;

class App
{
    /**
     * @return void
     */
    public static function run(): void
    {
        $config = new Config();
        (new ServerController())->run($config);
        (new LogLoopController())->run($config);
    }
}
