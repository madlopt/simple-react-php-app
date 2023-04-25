<?php

declare(strict_types=1);

namespace PhpSimpleApp\Config;

interface ConfigInterface
{
    public function getProjectName(): string;

    public function getStdoutLogTimeout(): int;

    public function getMetrics(): MetricsConfig;
}
