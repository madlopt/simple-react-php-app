<?php

declare(strict_types=1);

namespace PhpSimpleApp\Config;

class Config implements ConfigInterface
{
    private string $projectName;
    private int $stdoutLogTimeout;
    private MetricsConfig $metrics;

    public function __construct()
    {
        $this->projectName = getenv('PROJECT_NAME') ?: 'react-php-test-app';
        $this->stdoutLogTimeout = (int)getenv('CONSOLE_LOG_TIMEOUT') ?: 5000;
        $this->metrics = new MetricsConfig();
    }

    public function getProjectName(): string
    {
        return $this->projectName;
    }

    public function getStdoutLogTimeout(): int
    {
        return $this->stdoutLogTimeout;
    }

    public function getMetrics(): MetricsConfig
    {
        return $this->metrics;
    }
}
