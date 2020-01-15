<?php

namespace Optimus\Heimdal;

use Exception;
use ReflectionClass;
use InvalidArgumentException;
use Asm89\Stack\CorsService;
use Illuminate\Foundation\Exceptions\Handler as LaravelExceptionHandler;
use Optimus\Heimdal\Formatters\BaseFormatter;
use Optimus\Heimdal\Reporters\ReporterInterface;
use Illuminate\Contracts\Container\Container;

class ExceptionHandler extends LaravelExceptionHandler
{
    protected $config;

    protected $container;

    protected $debug;

    protected $reportResponses = [];

    /**
     * ExceptionHandler constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);

        $this->config = $container['config']->get('optimus.heimdal');
        $this->debug = $container['config']->get('app.debug');
    }

    /**
     * Report
     *
     * @param Exception $e
     * @throws Exception
     * @returns void
     */
    public function report(Exception $e)
    {
        parent::report($e);

        $this->reportResponses = [];

        if ($this->shouldntReport($e)) {
            return $this->reportResponses;
        }

        $reporters = $this->config['reporters'];

        foreach ($reporters as $key => $reporter) {
            $class = !isset($reporter['class']) ? null : $reporter['class'];

            if (
                is_null($class) ||
                !class_exists($class) ||
                !in_array(ReporterInterface::class, class_implements($class))
            ) {
                throw new InvalidArgumentException(
                    sprintf(
                        "%s: %s is not a valid reporter class.",
                        $key,
                        $class
                    )
                );
            }

            $config = isset($reporter['config']) && is_array($reporter['config']) ? $reporter['config'] : [];

            // $this->container->make($class)($config) fails php <= 5.4
            $reporterFactory = $this->container->make($class);
            $reporterInstance = $reporterFactory($config);

            $this->reportResponses[$key] = $reporterInstance->report($e);
        }
    }

    /**
     * Render
     *
     * @param \Illuminate\Http\Request $request
     * @param Exception $e
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $e)
    {
        $response = $this->generateExceptionResponse($request, $e);

        if ($this->config['add_cors_headers']) {
            if (!class_exists(CorsService::class)) {
                throw new InvalidArgumentException(
                    'asm89/stack-cors has not been installed. Optimus\Heimdal needs it for adding CORS headers to response.'
                );
            }

            /** @var CorsService $cors */
            $cors = $this->container->make(CorsService::class);
            $cors->addActualRequestHeaders($response, $request);
        }

        return $response;
    }

    /**
     * Generate exception response
     *
     * @param $request
     * @param Exception $e
     * @return mixed
     */
    private function generateExceptionResponse($request, Exception $e)
    {
        $formatters = $this->config['formatters'];

        // :: notation will otherwise not work for PHP <= 5.6
        $responseFactoryClass = $this->config['response_factory'];

        // Allow users to have a base formatter for every response.
        $response = $responseFactoryClass::make($e);

        foreach($formatters as $exceptionType => $formatter) {
            if (!($e instanceof $exceptionType)) {
                continue;
            }

            if (
                !class_exists($formatter) ||
                !(new ReflectionClass($formatter))->isSubclassOf(new ReflectionClass(BaseFormatter::class))
            ) {
                throw new InvalidArgumentException(
                    sprintf(
                        "%s is not a valid formatter class.",
                        $formatter
                    )
                );
            }

            $formatterInstance = new $formatter($this->config, $this->debug);
            $formatterInstance->format($response, $e, $this->reportResponses);

            break;
        }

        return $response;
    }

    /*
     * @returns array
     */
    public function getReportResponses()
    {
        return $this->reportResponses;
    }
}
