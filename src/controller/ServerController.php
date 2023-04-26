<?php

declare(strict_types=1);

namespace PhpSimpleApp\Controller;

use PhpSimpleApp\Config\ConfigInterface;
use Prometheus\CollectorRegistry;
use Prometheus\Exception\MetricsRegistrationException;
use Prometheus\RenderTextFormat;
use Prometheus\Storage\InMemory;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\HttpServer;
use React\Http\Message\Response;
use React\Socket\SocketServer;

class ServerController
{
    /**
     * @param ConfigInterface $config
     * @return void
     */
    public function run(ConfigInterface $config): void
    {
        $registry = new CollectorRegistry(new InMemory());
        $metrics = new MetricsController();
        try {
            $counter = $metrics->registerRequestsCounter($registry);
            $memoryUsageGauge = $metrics->registerMemoryUsageGauge($registry);
            $memoryPeakUsageGauge = $metrics->registerMemoryPeakUsageGauge($registry);
        } catch (MetricsRegistrationException $e) {
            echo sprintf("[%s] %s Error: " . $e->getMessage() . "\n", gmdate('Y-m-d H:i:s'), $config->getProjectName());
            exit(1);
        }

        $http = new HttpServer(function (ServerRequestInterface $request) use ($memoryPeakUsageGauge, $memoryUsageGauge, $registry, $counter, $config, $metrics) {
            $renderer = new RenderTextFormat();
            $result = $renderer->render($registry->getMetricFamilySamples());
            if ($request->getUri()->getPath() === $config->getMetrics()->getRoute()) {
                $metrics->updateHttpRequestsCounter($counter);
                $metrics->updateMemoryUsageGauge($memoryUsageGauge);
                $metrics->updateMemoryPeakUsageGauge($memoryPeakUsageGauge);

                return Response::plaintext(
                    $result
                );
            }

            return Response::plaintext('');
        });

        $socket = new SocketServer('0.0.0.0:' . $config->getMetrics()->getPort());
        $http->listen($socket);
    }
}
