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
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class GeneratorCommand
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class GeneratorCommand extends Command
{

    use ParserTrait, PrinterTrait, FileSystemTrait, FormatterTrait;

    /**
     * Root directory of all containers
     *
     * @var string
     */
    CONST ROOT = 'app';

    /**
     * Relative path for the stubs (relative to this directory / file)
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
     * @var string the name of the container to generate the stubs
     */
    protected $containerName;

    /**
     * @var string The name of the file to be created (entered by the user)
     */
    protected $fileName;

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

    private $defaultInputs = [
        ['container', 'c', InputOption::VALUE_OPTIONAL, 'The name of the container'],
        ['file', 'f', InputOption::VALUE_OPTIONAL, 'The name of the file to be created'],
    ];

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

        $this->containerName = $this->checkParameterOrAsk('container', 'Enter the name of the Container');
        $this->fileName = $this->checkParameterOrAsk('file', 'Enter the name of the ' . $this->fileType . ' to be created', $this->getDefaultFileName());

        $this->printStartedMessage($this->containerName, $this->fileName);

        // get user inputs
        $this->userData = $this->sanitizeUserData($this->getUserInputs());

        // get the actual path of the output file as well as the correct filename
        $this->parsedFileName = $this->parseFileStructure($this->nameStructure, $this->userData['file-parameters']);
        $this->filePath = $this->getFilePath($this->parsePathStructure($this->pathStructure, $this->userData['path-parameters']));

        // prepare stub content
        $this->stubContent = $this->fileSystem->get($this->getStubFile());
        $this->renderedStubContent = $this->parseStubContent($this->stubContent, $this->userData['stub-parameters']);

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
     * @param $path
     *
     * @return  string
     */
    protected function getFilePath($path)
    {
        // complete the missing parts of the path
        $path = base_path() . '/' .
                str_replace('\\', '/', self::ROOT . '/' . self::CONTAINER_DIRECTORY_NAME . '/' . $path) . '.php';

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
     * Get all the console command arguments, from the components. The default arguments are prepended
     *
     * @return array
     */
    protected function getOptions()
    {
        $arguments = array_merge($this->defaultInputs, $this->inputs);
        return $arguments;
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
     * Checks if the param is set (via CLI), otherwise asks the user for a value
     *
     * @param $param
     * @param $question
     * @param null $default
     * @return array|string
     */
    protected function checkParameterOrAsk($param, $question, $default = null)
    {
        // check if we have already have a param set
        $value = $this->option($param);
        if($value == null)
        {
            // there was no value provided via CLI, so ask the user..
            $value = $this->ask($question, $default);
        }

        return $value;
    }

    /**
     * Checks if the param is set (via CLI), otherwise proposes choices to the user
     *
     * @param $param
     * @param $question
     * @param $choices
     * @param null $default
     * @return array|string
     */
    protected function checkParameterOrChoice($param, $question, $choices, $default = null)
    {
        // check if we have already have a param set
        $value = $this->option($param);
        if($value == null)
        {
            // there was no value provided via CLI, so ask the user..
            $value = $this->choice($question, $choices, $default);
        }

        return $value;
    }

    protected function checkParameterOrConfirm($param, $question, $default = false)
    {
        // check if we have already have a param set
        $value = $this->option($param);
        if($value == null)
        {
            // there was no value provided via CLI, so ask the user..
            $value = $this->confirm($question, $default);
        }

        // we need to parse the output value to a boolean value, as the values are strings (e.g., "true"), when they
        // are read from the command line...
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Checks, if the data from the generator contains path, stub and file-parameters.
     * Adds empty arrays, if they are missing
     *
     * @param $data
     * @return mixed
     */
    private function sanitizeUserData($data) {

        if(! array_key_exists('path-parameters', $data)) {
            $data['path-parameters'] = array();
        }

        if(! array_key_exists('stub-parameters', $data)) {
            $data['stub-parameters'] = array();
        }

        if(! array_key_exists('file-parameters', $data)) {
            $data['file-parameters'] = array();
        }

        return $data;
    }

    /**
     * Get the default file name for this component to be generated
     *
     * @return string
     */
    protected function getDefaultFileName()
    {
        return 'Default' . Str::ucfirst($this->fileType);
    }
}
