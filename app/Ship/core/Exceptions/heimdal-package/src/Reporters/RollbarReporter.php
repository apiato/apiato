<?php

namespace Optimus\Heimdal\Reporters;

use Exception;
use Rollbar;
use InvalidArgumentException;

class RollbarReporter implements ReporterInterface
{
    /**
     * RollbarReporter constructor.
     * @param array $config
     * @throws \InvalidArgumentException
     */
    public function __construct(array $config)
    {
        if (!class_exists(Rollbar::class)) {
            throw new InvalidArgumentException('Rollbar client is not installed. Use composer require rollbar/rollbar');
        }

        Rollbar::init($config);
    }

    /**
     * Report exception
     *
     * @param Exception $exception
     * @return string|void
     */
    public function report(Exception $exception)
    {
        return Rollbar::report_exception($exception);
    }
}
