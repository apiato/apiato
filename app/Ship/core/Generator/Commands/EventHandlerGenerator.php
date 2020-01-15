<?php

namespace Apiato\Core\Generator\Commands;

use Apiato\Core\Generator\GeneratorCommand;
use Apiato\Core\Generator\Interfaces\ComponentsGenerator;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class EventHandlerGenerator
 *
 * @author  Johannes Schobel  <johannes.schobel@googlemail.com>
 */
class EventHandlerGenerator extends GeneratorCommand implements ComponentsGenerator
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'apiato:generate:eventhandler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new EventHandler class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $fileType = 'EventHandler';

    /**
     * The structure of the file path.
     *
     * @var  string
     */
    protected $pathStructure = '{container-name}/Events/Handlers/*';

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
    protected $stubName = 'events/eventhandler.stub';

    /**
     * User required/optional inputs expected to be passed while calling the command.
     * This is a replacement of the `getArguments` function "which reads whenever it's called".
     *
     * @var  array
     */
    public $inputs = [
        ['event', null, InputOption::VALUE_OPTIONAL, 'The Event to generate this Handler for'],
    ];

    /**
     * @return array
     */
    public function getUserInputs()
    {
        $event = $this->checkParameterOrAsk('event', 'Enter the name of the Event to generate this Handler for');

        $this->printInfoMessage('!!! Do not forget to register the Event and/or EventHandler !!!');

        return [
            'path-parameters' => [
                'container-name' => $this->containerName,
            ],
            'stub-parameters' => [
                'container-name' => $this->containerName,
                'class-name' => $this->fileName,
                'model' => $event,
            ],
            'file-parameters' => [
                'file-name' => $this->fileName,
            ],
        ];
    }

}
