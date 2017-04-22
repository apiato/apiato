<?php

namespace App\Ship\Generator;

use App\Ship\Generator\Exceptions\GeneratorErrorException;
use App\Ship\Generator\Interfaces\ComponentsGenerator;
use App\Ship\Generator\Traits\FileSystemTrait;
use App\Ship\Generator\Traits\FormatterTrait;
use App\Ship\Generator\Traits\ParserTrait;
use App\Ship\Generator\Traits\PrinterTrait;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem as IlluminateFilesystem;

/**
 * Class GeneratorCommand
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
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

    /**
     * @var string
     */
    protected $filePath;

    /**
     * @var string
     */
    protected $containerName;

    /**
     * @var string
     */
    protected $userData;

    /**
     * @var string
     */
    protected $parsedFileName;

    /**
     * @var string
     */
    protected $stubContent;

    /**
     * @var string
     */
    protected $renderedStubContent;

    /**
     * @var  \Illuminate\Filesystem\Filesystem
     */
    private $fileSystem;

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
        $this->validateGenerator($this);

        // read required inputs. Every command must pass `container name` and `file name`
        $this->containerName = $this->getInput('container-name');
        $this->fileName = $this->getInput('file-name');

        $this->printStartedMessage($this->containerName, $this->fileName);

        // get the actual path of the output file
        $this->filePath = $this->getFilePath($this->parsePathStructure($this->pathStructure));

        // prepare stub content
        $this->stubContent = $this->fileSystem->get($this->getStubFile());

        // get user inputs
        $this->userData = $this->getUserInputs();

        // parse the file name according to user input
        $this->parsedFileName = $this->parseFilename($this->userData['file-parameters']);

        // render the stub
        $this->renderedStubContent = $this->renderStub($this->userData['stub-parameters']);

        $this->generateFile($this->filePath, $this->renderedStubContent);

        $this->printFinishedMessage($this->fileType);
    }

    /**
     * @param $generator
     *
     * @throws \App\Ship\Generator\Exceptions\GeneratorErrorException
     */
    private function validateGenerator($generator)
    {
        if (!$generator instanceof ComponentsGenerator) {
            throw new GeneratorErrorException(
                'Your component maker command should implement ComponentsGenerator interface.'
            );
        }
    }

    /**
     * @param array $arguments
     *
     * @return  mixed
     */
    private function parseFilename(array $arguments = [])
    {
        $map = $this->getFileNameParsingMap(...$arguments);

        foreach ($map as $key => $value) {
            $this->nameStructure = str_replace($key, $value, $this->nameStructure);
        }

        // after the loop is done $nameStructure will be come a parsed $nameStructure so I set it as $fileName
        return $this->nameStructure;
    }

    /**
     * @param $renderArguments
     *
     * @return  mixed
     */
    public function renderStub($renderArguments)
    {
        $map = $this->getStubRenderMap(...$renderArguments);

        foreach ($map as $key => $value) {
            $this->stubContent = str_replace($key, $value, $this->stubContent);
        }

        return $this->stubContent;
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
     * @return  mixed
     */
    protected function getStubFile()
    {
        $path = __DIR__ . '/' . self::STUB_PATH;

        return str_replace('*', $this->stubName, $path);
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

}
