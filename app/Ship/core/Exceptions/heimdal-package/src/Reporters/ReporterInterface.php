<?php

namespace Optimus\Heimdal\Reporters;

use Exception;

interface ReporterInterface
{
    public function report(Exception $e);
}
