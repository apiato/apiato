<?php

namespace Optimus\Heimdal\Reporters;

use Exception;
use InvalidArgumentException;
use Raven_Client;
use Optimus\Heimdal\Reporters\ReporterInterface;

class SentryReporter implements ReporterInterface
{
    private $config;

    public function __construct(array $config)
    {
        $config = $this->extendConfig($config);

        if (!class_exists(Raven_Client::class)) {
            throw new InvalidArgumentException("Sentry client is not installed. Use composer require sentry/sentry.");
        }

        $this->config = $config;
    }

    public function report(Exception $e)
    {
        $options = $this->config['sentry_options'];

        $raven = new Raven_Client(
            $this->config['dsn'],
            $options
        );

        $data = null;
        if (isset($options['add_context']) && is_callable($options['add_context'])) {
            $data = $options['add_context']($e);
        }

        return $raven->captureException($e, $data);
    }

    public function extendConfig(array $config)
    {
        if (!isset($config['sentry_options'])) {
            $config['sentry_options'] = [];
        }

        if (!isset($config['sentry_options']['tags'])) {
            $config['sentry_options']['tags'] = [];
        }

        if (!isset($config['sentry_options']['tags']['php_version'])) {
            $config['sentry_options']['tags']['php_version'] = phpversion();
        }

        if (!isset($config['sentry_options']['tags']['environment'])) {
            $config['sentry_options']['tags']['environment'] = app()->environment();
        }

        return $config;
    }
}
