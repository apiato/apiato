<?php

namespace App\Ship\Generator\Commands;

use App\Ship\Generator\GeneratorCommand;
use App\Ship\Generator\Interfaces\ComponentsGenerator;

/**
 * Class ExceptionGenerator
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ExceptionGenerator extends GeneratorCommand implements ComponentsGenerator
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'apiato:exception';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Exception class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $fileType = 'Exception';

    /**
     * The structure of the file path.
     *
     * @var  string
     */
    protected $pathStructure = '{container-name}/Exceptions/*';

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
    protected $stubName = 'exception.stub';

    /**
     * User required/optional inputs expected to be passed while calling the command.
     * This is a replacement of the `getArguments` function "which reads whenever it's called".
     *
     * @var  array
     */
    public $inputs = [
    ];

    /**
     * urn mixed|void
     */
    public function getUserInputs()
    {
        return [
            'path-parameters' => [
                'container-name' => $this->containerName,
            ],
            'stub-parameters' => [
                'container-name' => $this->containerName,
                'class-name' => $this->fileName,
            ],
            'file-parameters' => [
                'file-name' => $this->fileName,
            ],
        ];
    }
}
