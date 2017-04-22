<?php

namespace App\Ship\Generator\Commands;

use App\Ship\Generator\GeneratorCommand;
use App\Ship\Generator\Interfaces\ComponentsGenerator;
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
    protected $name = 'apiato:route';

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
        ['container-name', InputArgument::REQUIRED, 'The name of the container'],
        ['file-name', InputArgument::REQUIRED, 'The name of the endpoint (CreateUser, DeleteItem, ...)'],
        ['ui', InputArgument::REQUIRED, 'The UI of the route (Web or Api)'],
        ['operation', InputArgument::OPTIONAL, 'The operation (*, Create, Read, Update, Delete, List)'],
        ['type', InputArgument::OPTIONAL, 'The type of the endpoint (private, public)'],
        ['version', InputArgument::OPTIONAL, 'The version of the endpoint (1, 2, ...)'],
        ['url', InputArgument::OPTIONAL, 'The URL of the endpoint (/stores, /cars, ...)'],
        ['verb', InputArgument::OPTIONAL, 'The HTTP verb of the endpoint (Get, Post, ...)'],
    ];

    /**
     * @return  array
     */
    public function getUserInputs()
    {
        $container = $this->getInput('container-name');
        $file = Str::ucfirst($this->getInput('file-name'));


        $version = $this->getInput('version') ? : self::DEFAULT_VERSION;
        $type = $this->getInput('type') ? : self::DEFAULT_TYPE;

        $operation = Str::ucfirst($this->getInput('operation')); // TODO Later: if operation = null read it from the name
        $url = $this->getInput('url');
        $verb = $this->getInput('verb');
        $ui = $this->getInput('ui');

        return [
            'stub-parameters' => [
                $container,
                $file,
                $operation,
                $url,
                $version,
                $verb,
                $ui,
            ],
            'file-parameters' => [
                $file,
                $type,
                $version,
//                $this->fileName = $this->getInput('name');
            ],
        ];
    }

    /**
     * @param $container
     * @param $endpointName
     * @param $operation
     * @param $url
     * @param $version
     * @param $verb
     * @param $ui
     *
     * @return  array
     */
    public function getStubRenderMap($container, $endpointName, $operation, $url, $version, $verb, $ui)
    {
        return [
            '{{container-name}}'   => $container,
            '{{operation}}'        => $operation,
            '{{http-verb}}'        => $verb,
            '{{endpoint-url}}'     => $url,
            '{{endpoint-version}}' => $version,
        ];
    }

    /**
     * @param $endpointName
     * @param $endpointType
     * @param $endpointVersion
     *
     * @return  array
     */
    public function getFileNameParsingMap($endpointName, $endpointType, $endpointVersion)
    {
        return [
            '{endpoint-name}'      => $endpointName,
            '{documentation-type}' => $endpointType,
            '{endpoint-version}'   => 'v' . $endpointVersion,
        ];
    }

}
