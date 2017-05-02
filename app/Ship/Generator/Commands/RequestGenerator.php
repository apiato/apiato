<?php

namespace App\Ship\Generator\Commands;

use App\Ship\Generator\GeneratorCommand;
use App\Ship\Generator\Interfaces\ComponentsGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class RequestGenerator
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class RequestGenerator extends GeneratorCommand implements ComponentsGenerator
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'apiato:request';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Request class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $fileType = 'Request';

    /**
     * The structure of the file path.
     *
     * @var  string
     */
    protected $pathStructure = '{container-name}/UI/{user-interface}/Requests/*';

    /**
     * The structure of the file name.
     *
     * @var  string
     */
    protected $nameStructure = '{file-name}';

    /**
     * The name of the stub file.
     *
     * @var  string
     */
    protected $stubName = 'request.stub';

    /**
     * User required/optional inputs expected to be passed while calling the command.
     * This is a replacement of the `getArguments` function "which reads whenever it's called".
     *
     * @var  array
     */
    public $inputs = [
        ['ui', null, InputOption::VALUE_OPTIONAL, 'The user-interface to generate the Request for.'],
    ];

    /**
     * urn mixed|void
     */
    public function getUserInputs()
    {
        $ui = Str::lower($this->checkParameterOrChoice('ui', 'Select the UI for the controller', ['API', 'WEB']));

        return [
            'path-parameters' => [
                'container-name' => $this->containerName,
                'user-interface' => Str::upper($ui),
            ],
            'stub-parameters' => [
                'container-name' => $this->containerName,
                'class-name' => $this->fileName,
                'user-interface' => Str::upper($ui),
            ],
            'file-parameters' => [
                'file-name' => $this->fileName,
            ],
        ];
    }
}
