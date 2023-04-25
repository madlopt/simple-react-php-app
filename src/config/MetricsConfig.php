<?php

declare(strict_types=1);

namespace PhpSimpleApp\Config;

class MetricsConfig
{
    private string $method;
    private string $route;
    private int|string $port;
    private string $component;
    private string $source;
    private string $namespace;
    private int|string $collectInterval;

    public function __construct()
    {
        $this->method = getenv('METRICS_METHOD') ?: 'GET';
        $this->route = getenv('METRICS_ROUTE') ?: '/metrics';
        $this->port = getenv('METRICS_PORT') ?: 8000;
        $this->component = getenv('METRICS_COMPONENT') ?: 'applications';
        $this->source = getenv('METRICS_SOURCE') ?: 'react-php-test-app';
        $this->namespace = getenv('METRICS_NAMESPACE') ?: 'default';
        $this->collectInterval = getenv('METRICS_COLLECT_INTERVAL') ?: 10;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return (int)$this->port;
    }

    /**
     * @return string
     */
    public function getComponent(): string
    {
        return $this->component;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * @return int
     */
    public function getCollectInterval(): int
    {
        return (int)$this->collectInterval;
    }

}
