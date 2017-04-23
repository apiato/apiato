<?php

namespace App\Ship\Generator\Commands;

use App\Ship\Generator\GeneratorCommand;
use App\Ship\Generator\Interfaces\ComponentsGenerator;
use Symfony\Component\Console\Input\InputArgument;

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
        ['container-name', InputArgument::REQUIRED, 'The name of the container'],
        ['file-name', InputArgument::REQUIRED, 'The name of the file (UpdateUser, CreateStore)'],
    ];

    /**
     * urn mixed|void
     */
    public function getUserInputs()
    {
        $container = $this->getInput('container-name');
        $file = $this->getInput('file-name');

        return [
            'stub-parameters' => [
                $container,
                $file,
            ],
            'file-parameters' => [
                $file,
                $this->fileType
            ],
        ];
    }

    /**
     * @return  array
     */
    public function getStubRenderMap($containerName, $fileName)
    {
        return [
            '{{container-name}}' => $containerName,
            '{{class-name}}'     => $fileName,
        ];
    }


    /**
     * @return  array
     */
    public function getFileNameParsingMap($file, $type)
    {
        return [
            '{file-name}' => $file,
            '{file-type}' => $type,
        ];
    }

}
