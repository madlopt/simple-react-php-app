<?php

declare(strict_types=1);

namespace PhpSimpleApp\Controller;

use PhpSimpleApp\Config\ConfigInterface;
use React\EventLoop\Loop;

class LogLoopController
{
    /**
     * @param ConfigInterface $config
     * @return void
     */
    public function run(ConfigInterface $config): void
    {
        $logMessage = function () use ($config) {
            echo sprintf("[%s] %s is alive\n", gmdate('Y-m-d H:i:s'), $config->getProjectName());
        };

        $loop = new Loop();
        $loop->addPeriodicTimer($config->getStdoutLogTimeout() / 1000, $logMessage);

        echo sprintf("[%s] %s is started\n", gmdate('Y-m-d H:i:s'), $config->getProjectName());

        $loop->run();
    }
}
