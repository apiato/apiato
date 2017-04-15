<?php

namespace App\Ship\Generator;

use App\Ship\Generator\Exceptions\GeneratorErrorException;
use App\Ship\Generator\Interfaces\ComponentsGenerator;
use App\Ship\Generator\Traits\FileSystemTrait;
use App\Ship\Generator\Traits\FormatterTrait;
use App\Ship\Generator\Traits\ParserTrait;
use App\Ship\Generator\Traits\PrinterTrait;
use Closure;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem as IlluminateFilesystem;

abstract class GeneratorCommand extends Command
{

    use ParserTrait, PrinterTrait, FileSystemTrait, FormatterTrait;

    /**
     * Root of all container
     *
     * @var string
     */
    CONST ROOT = 'app';

    /**
     * This starts from this directory.
     *
     * @var string
     */
    CONST STUB_PATH = 'Stubs/*';

    /**
     * Containers main folder
     *
     * @var string
     */
    CONST CONTAINER_DIRECTORY_NAME = 'Containers';

    protected $fileName;

    protected $containerName;

    protected $stubContent;

    protected $filePath;

    /**
     * GeneratorCommand constructor.
     *
     * @param \Illuminate\Filesystem\Filesystem $fileSystem
     */
    public function __construct(IlluminateFilesystem $fileSystem)
    {
        parent::__construct();

        $this->fileSystem = $fileSystem;
    }

    /**
     * @void
     * @throws \App\Ship\Generator\Exceptions\GeneratorErrorException
     */
    public function fire()
    {
        if (!$this instanceof ComponentsGenerator) {
            throw new GeneratorErrorException(
                'Your component maker command should implement ComponentsGenerator interface.'
            );
        }

        // $initialize should be called after finishing collecting arguments in the generator.
        // To prevent the user from having to call these functions in the same order from each component generator.
        $initialize = function () {

            $this->printStartedMessage();

            // get the actual path of the output file
            $this->filePath = $this->getFilePath($this->parsePathStructure());

            // prepare stub content
            $this->stubContent = $this->getStubContent();
        };

        // $terminate should be called after finishing rendering the stub in the generator.
        // To prevent the user from having to call these functions in the same order from each component generator.
        $terminate = function () {

            $this->generateFile();

            $this->printFinishedMessage();
        };

        // let's call fireMe on the component, to collect user inputs and render the stub of the fired generator
        $this->fireMe($initialize, $terminate);
    }

    /**
     * @param $path
     *
     * @return  string
     */
    protected function getFilePath($path)
    {
        // complete the missing parts of the path
        $path = base_path() . '/' . str_replace('\\', '/',
                self::ROOT . '/' . self::CONTAINER_DIRECTORY_NAME . '/' . $path) . '.php';

        // try to create directory
        $this->createDirectory($path);

        // return full path
        return $path;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStubFile()
    {
        $path = __DIR__ . '/' . self::STUB_PATH;

        return str_replace('*', $this->stubName, $path);
    }

    /**
     * @return  string
     */
    protected function getStubContent()
    {
        return $this->fileSystem->get($this->getStubFile());
    }

    /**
     * Get all the console command arguments, form the components.
     *
     * @return array
     */
    protected function getArguments()
    {
        return $this->inputs;
    }

    /**
     * @param      $arg
     * @param bool $trim
     *
     * @return  array|string
     */
    protected function getInput($arg, $trim = true)
    {
        return $trim ? $this->trimString($this->argument($arg)) : $this->argument($arg);
    }


    /**
     * @return  string
     */
    public function getAndAssignInputContainerName()
    {
        return $this->containerName = $this->getInput('container');
    }

    /**
     * @param array $args
     *
     * @return  mixed
     */
    public function getAndAssignInputFilename(array $args = array())
    {

        $map = $this->parseFilename(...$args);

        foreach ($map as $key => $value) {
            $this->nameStructure = str_replace($key, $value, $this->nameStructure);
        }

        // after the loop is done $nameStructure will be come a parsed $nameStructure so I set it as $fileName
        return $this->fileName = $this->nameStructure;
    }

    /**
     * This is just a facilitator function, instead of calling these 3 lines over and over from each component generator
     * let the generator call this function at the end and it will take care of invoking those closure and calling the
     * render function for you, at the end.
     *
     * @param \Closure $initializeWhenArgumentsReady
     * @param \Closure $terminateWhenStubReady
     * @param          $renderArguments
     */
    public function _callRenderStub(
        Closure $initializeWhenArgumentsReady,
        Closure $terminateWhenStubReady,
        $renderArguments
    ) {

        $initializeWhenArgumentsReady();

        $map = $this->renderStub(...$renderArguments);

        foreach ($map as $key => $value) {
            $this->stubContent = str_replace($key, $value, $this->stubContent);
        }

        $terminateWhenStubReady();
    }

}
