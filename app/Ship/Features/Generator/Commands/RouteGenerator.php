<?php

namespace App\Ship\Features\Generator\Commands;

use App\Ship\Features\Generator\GeneratorCommand;
use App\Ship\Features\Generator\Interfaces\ComponentsGenerator;
use Closure;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class RouteGenerator
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class RouteGenerator extends GeneratorCommand implements ComponentsGenerator
{

    /**
     * Default version number.
     *
     * @var string
     */
    CONST DEFAULT_VERSION = "1";

    /**
     * Default endpoint type.
     *
     * @var string
     */
    CONST DEFAULT_TYPE = "private";

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'z-generate:route';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Route class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $fileType = 'Route';

    /**
     * THe structure of the file path.
     *
     * @var  string
     */
    protected $pathStructure = '{container-name}/UI/API/Routes/*';

    /**
     * The structure of the file name.
     *
     * @var  string
     */
    protected $nameStructure = '{endpoint-name}.{endpoint-version}.{documentation-type}';

    /**
     * The name of the stub file.
     *
     * @var  string
     */
    protected $stubName = 'route.stub';

    /**
     * User required/optional inputs expected to be passed while calling the command.
     * This is a replacement of the `getArguments` function "which reads whenever it's called".
     *
     * @var  array
     */
    public $inputs = [
        ['container', InputArgument::REQUIRED, 'The name of the container'],
        ['name', InputArgument::REQUIRED, 'The name of the endpoint (CreateUser, DeleteItem, ...)'],
        ['ui', InputArgument::REQUIRED, 'The UI of the route (Web or Api)'],
        ['operation', InputArgument::OPTIONAL, 'The operation (*, Create, Read, Update, Delete, List)'],
        ['type', InputArgument::OPTIONAL, 'The type of the endpoint (private, public)'],
        ['version', InputArgument::OPTIONAL, 'The version of the endpoint (1, 2, ...)'],
        ['url', InputArgument::OPTIONAL, 'The URL of the endpoint (/stores, /cars, ...)'],
        ['verb', InputArgument::OPTIONAL, 'The HTTP verb of the endpoint (Get, Post, ...)'],
    ];

    /**
     * This function get called by the fire function (at it's parent class) when the command is called,
     * to renders the stub with data collected from the user as input (while calling the command and by
     * his answers to the questions).
     * > How to use it:
     *     Add more formatted user input to the array argument and handle the rendering in the render function below.
     *
     * @param \Closure $argumentsReady
     * @param \Closure $stubReady
     */
    public function fireMe(Closure $argumentsReady, Closure $stubReady)
    {

        $version = $this->getInput('version') ? : self::DEFAULT_VERSION;
        $type = $this->getInput('type') ? : self::DEFAULT_TYPE;
        $endpointName = Str::ucfirst($this->getInput('name'));

        $this->getAndAssignInputContainerName();
        $this->getAndAssignInputFilename([$endpointName, $type, $version]);

        $operation = Str::ucfirst($this->getInput('operation')); // TODO Later: if operation = null read it from the name
        $url = $this->getInput('url');
        $verb = $this->getInput('verb');
        $ui = $this->getInput('ui');
        

        // TODO: based on the operation you will need to create single or multiple endpoints and you will need to change the code inside those

        $this->_callRenderStub($argumentsReady, $stubReady, [
            $operation,
            $url,
            $version,
            $verb
        ]);
    }


    /**
     * @param $operation
     * @param $url
     * @param $version
     * @param $verb
     *
     * @return  array
     */
    public function renderStub($operation, $url, $version, $verb)
    {
        return [
            '{{container-name}}'   => $this->containerName,
            '{{operation}}'        => $operation,
            '{{http-verb}}'        => $verb,
            '{{endpoint-url}}'     => $url,
            '{{endpoint-version}}' => $version,
        ];
    }

    /**
     * @param $endpointName
     * @param $endpointVersion
     * @param $endpointType
     *
     * @return  mixed|string
     */
    public function parseFilename($endpointName, $endpointType, $endpointVersion)
    {
        return [
            '{endpoint-name}'      => $endpointName,
            '{documentation-type}' => $endpointType,
            '{endpoint-version}'   => 'v' . $endpointVersion,
        ];
    }

}
