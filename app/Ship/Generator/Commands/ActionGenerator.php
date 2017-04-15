<?php

namespace App\Ship\Generator\Commands;

use App\Ship\Generator\GeneratorCommand;
use App\Ship\Generator\Interfaces\ComponentsGenerator;
use Closure;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class ActionGenerator
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ActionGenerator extends GeneratorCommand implements ComponentsGenerator
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'apiato:action';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Action class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $fileType = 'Action';

    /**
     * The structure of the file path.
     *
     * @var  string
     */
    protected $pathStructure = '{container-name}/Actions/*';

    /**
     * The structure of the file name.
     *
     * @var  string
     */
    protected $nameStructure = '{file-name}{file-type}';

    /**
     * The name of the stub file.
     *
     * @var  string
     */
    protected $stubName = 'action.stub';

    /**
     * User required/optional inputs expected to be passed while calling the command.
     * This is a replacement of the `getArguments` function "which reads whenever it's called".
     *
     * @var  array
     */
    public $inputs = [
        ['container', InputArgument::REQUIRED, 'The name of the container'],
        ['file', InputArgument::REQUIRED, 'The name of the file (UpdateUser, CreateStore)'],
        ['operation', InputArgument::OPTIONAL, 'The operation (All, Create, Read, Update, Delete, List)'],
    ];

    /**
     * @param \Closure $argumentsReady
     * @param \Closure $stubReady
     *
     * @return mixed|void
     */
    public function fireMe(Closure $argumentsReady, Closure $stubReady)
    {
        $this->getAndAssignInputContainerName();
        $this->getAndAssignInputFilename();

        // TODO: Get operation and pass it to the render to fill the class with the right code. sub stubs

        $this->_callRenderStub($argumentsReady, $stubReady, []);
    }

    /**
     * @return  array
     */
    public function renderStub()
    {
        return [
            '{{container-name}}' => $this->containerName,
            '{{class-name}}'     => $this->fileName,
        ];
    }


    /**
     * @return  array
     */
    public function parseFilename()
    {
        return [
            '{file-name}' => $this->getInput('file'),
            '{file-type}' => $this->fileType,
        ];
    }

}
