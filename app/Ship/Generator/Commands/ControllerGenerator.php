<?php

namespace App\Ship\Generator\Commands;

use App\Ship\Generator\GeneratorCommand;
use App\Ship\Generator\Interfaces\ComponentsGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class ControllerGenerator
 *
 * @author  Johannes Schobel  <johannes.schobel@googlemail.com>
 */
class ControllerGenerator extends GeneratorCommand implements ComponentsGenerator
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'apiato:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Controller class for a given UI (i.e., API or WEB)';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $fileType = 'Controller';

    /**
     * The structure of the file path.
     *
     * @var  string
     */
    protected $pathStructure = '{container-name}/UI/{user-interface}/Controllers/*';

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
    protected $stubName = 'controller.stub';

    /**
     * The options which can be passed to the command. All options are optional. You do not need to pass the
     * "--container" and "--file" options, as they are globally handled. Just use the options which are specific to
     * this generator.
     *
     * @var  array
     */
    public $inputs = [
        ['ui', null, InputOption::VALUE_OPTIONAL, 'The user-interface to generate the Controller for.'],
        ['crud', null, InputOption::VALUE_OPTIONAL, 'Generate all CRUD methods (may differ for the specified user-interface).'],
    ];

    /**
     * @return  array
     */
    public function getUserInputs()
    {
        $ui = Str::lower($this->checkParameterOrChoice('ui', 'Select the UI for the controller', ['API', 'WEB']));

        $crud = $this->checkParameterOrConfirm('crud', 'Would you like to generate a CRUD stub for the controller', false);

        if($crud == true) {
            $this->stubName = 'controller.crud.' . Str::lower($ui) . ".stub";
        }

        $basecontroller = Str::ucfirst($ui) . 'Controller';

        return [
            'path-parameters' => [
                'container-name'    => $this->containerName,
                'user-interface'    => Str::upper($ui),
            ],
            'stub-parameters' => [
                'container-name'    => $this->containerName,
                'class-name'         => $this->fileName,
                'user-interface'    => Str::upper($ui),
                'base-controller'   => $basecontroller,
            ],
            'file-parameters' => [
                'file-name'         => $this->fileName,
            ],
        ];
    }

    public function getDefaultFileName()
    {
        return 'Controller';
    }
}
