<?php

namespace App\Ship\Generator\Commands;

use App\Ship\Generator\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use App\Ship\Generator\Interfaces\ComponentsGenerator;

/**
 * Class ModelGenerator
 *
 * @author  Justin Atack  <justinatack@gmail.com>
 */
class ModelGenerator extends GeneratorCommand implements ComponentsGenerator
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'apiato:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Model class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $fileType = '';

    /**
     * The structure of the file path.
     *
     * @var  string
     */
    protected $pathStructure = '{container-name}/Models/*';

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
    protected $stubName = 'model.stub';

    /**
     * User required/optional inputs expected to be passed while calling the command.
     * This is a replacement of the `getArguments` function "which reads whenever it's called".
     *
     * @var  array
     */
    public $inputs = [
        ['container-name', InputArgument::REQUIRED, 'The name of the container'],
        ['file-name', InputArgument::REQUIRED, 'The name of the model/file name e.g. User, Product.'],
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
                $this->fileType,
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
