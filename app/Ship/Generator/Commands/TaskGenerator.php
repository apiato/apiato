<?php

namespace App\Ship\Generator\Commands;

use App\Ship\Generator\GeneratorCommand;
use App\Ship\Generator\Interfaces\ComponentsGenerator;

/**
 * Class TaskGenerator
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class TaskGenerator extends GeneratorCommand implements ComponentsGenerator
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'apiato:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Task class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $fileType = 'Task';

    /**
     * The structure of the file path.
     *
     * @var  string
     */
    protected $pathStructure = '{container-name}/Tasks/*';

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
    protected $stubName = 'task.stub';

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
