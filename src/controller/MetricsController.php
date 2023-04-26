<?php

declare(strict_types=1);

namespace PhpSimpleApp\Controller;

use Prometheus\CollectorRegistry;
use Prometheus\Counter;
use Prometheus\Exception\MetricsRegistrationException;
use Prometheus\Gauge;

class MetricsController
{
    /**
     * @throws MetricsRegistrationException
     */
    public function registerMemoryUsageGauge(CollectorRegistry $registry): Gauge
    {
        return $registry->getOrRegisterGauge('', 'memory_usage', 'current memory usage in bytes');
    }

    /**
     * @throws MetricsRegistrationException
     */
    public function registerMemoryPeakUsageGauge(CollectorRegistry $registry): Gauge
    {
        return $registry->getOrRegisterGauge('', 'memory_peak_usage', 'peak memory usage in bytes');
    }

    /**
     * @throws MetricsRegistrationException
     */
    public function registerRequestsCounter(CollectorRegistry $registry): Counter
    {
        return $registry->getOrRegisterCounter('', 'http_requests_counter', 'number of http requests');
    }

    /**
     * @param Gauge $gauge
     * @return Gauge
     */
    public function updateMemoryUsageGauge(Gauge $gauge): Gauge
    {
        $gauge->set(memory_get_usage(true));

        return $gauge;
    }

    /**
     * @param Gauge $gauge
     * @return Gauge
     */
    public function updateMemoryPeakUsageGauge(Gauge $gauge): Gauge
    {
        $gauge->set(memory_get_peak_usage(true));

        return $gauge;
    }

    /**
     * @param Counter $counter
     * @return Counter
     */
    public function updateHttpRequestsCounter(Counter $counter): Counter
    {
        $counter->inc();

        return $counter;
    }
}
