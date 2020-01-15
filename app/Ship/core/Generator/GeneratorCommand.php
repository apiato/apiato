<?php

namespace Apiato\Core\Generator;

use Apiato\Core\Generator\Exceptions\GeneratorErrorException;
use Apiato\Core\Generator\Interfaces\ComponentsGenerator;
use Apiato\Core\Generator\Traits\FileSystemTrait;
use Apiato\Core\Generator\Traits\FormatterTrait;
use Apiato\Core\Generator\Traits\ParserTrait;
use Apiato\Core\Generator\Traits\PrinterTrait;
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
     * Relative path for the custom stubs (relative to the app/Ship directory!
     */
    CONST CUSTOM_STUB_PATH = 'Generators/CustomStubs/*';

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
        ['container', null, InputOption::VALUE_OPTIONAL, 'The name of the container'],
        ['file', null, InputOption::VALUE_OPTIONAL, 'The name of the file'],
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
     *
     * @throws \Apiato\Core\Generator\Exceptions\GeneratorErrorException
     */
    public function handle()
    {
        $this->validateGenerator($this);

        $this->containerName = ucfirst($this->checkParameterOrAsk('container', 'Enter the name of the Container'));
        $this->fileName = $this->checkParameterOrAsk('file', 'Enter the name of the ' . $this->fileType . ' file', $this->getDefaultFileName());

        // now fix the container and file name
        $this->containerName = $this->removeSpecialChars($this->containerName);
        $this->fileName = $this->removeSpecialChars($this->fileName);

        // and we are ready to start
        $this->printStartedMessage($this->containerName, $this->fileName);

        // get user inputs
        $this->userData = $this->getUserInputs();

        if ($this->userData === null) {
            // the user skipped this step
            return;
        }
        $this->userData = $this->sanitizeUserData($this->userData);

        // get the actual path of the output file as well as the correct filename
        $this->parsedFileName = $this->parseFileStructure($this->nameStructure, $this->userData['file-parameters']);
        $this->filePath = $this->getFilePath($this->parsePathStructure($this->pathStructure, $this->userData['path-parameters']));

        if (! $this->fileSystem->exists($this->filePath)) {

            // prepare stub content
            $this->stubContent = $this->getStubContent();
            $this->renderedStubContent = $this->parseStubContent($this->stubContent, $this->userData['stub-parameters']);

            $this->generateFile($this->filePath, $this->renderedStubContent);

            $this->printFinishedMessage($this->fileType);
        }

        // exit the command successfully
        return 0;
    }

    /**
     * @param $generator
     *
     * @throws \Apiato\Core\Generator\Exceptions\GeneratorErrorException
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
                str_replace('\\', '/', self::ROOT . '/' . self::CONTAINER_DIRECTORY_NAME . '/' . $path) . '.' . $this->getDefaultFileExtension();

        // try to create directory
        $this->createDirectory($path);

        // return full path
        return $path;
    }

    /**
     * @return  mixed
     */
    protected function getStubContent()
    {
        // check if there is a custom file that overrides the default stubs
        $path = app_path() . '/Ship/' . self::CUSTOM_STUB_PATH;
        $file = str_replace('*', $this->stubName, $path);

        // check if the custom file exists
        if (! $this->fileSystem->exists($file)) {
            // it does not exist - so take the default file!
            $path = __DIR__ . '/' . self::STUB_PATH;
            $file = str_replace('*', $this->stubName, $path);
        }

        // now load the stub
        $stub = $this->fileSystem->get($file);
        return $stub;
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

    /**
     * @param      $param
     * @param      $question
     * @param bool $default
     *
     * @return mixed
     */
    protected function checkParameterOrConfirm($param, $question, $default = false)
    {
        // check if we have already have a param set
        $value = $this->option($param);
        if ($value === null)
        {
            // there was no value provided via CLI, so ask the user..
            $value = $this->confirm($question, $default);
        }

        return $value;
    }

    /**
     * Checks, if the data from the generator contains path, stub and file-parameters.
     * Adds empty arrays, if they are missing
     *
     * @param $data
     * @return mixed
     */
    private function sanitizeUserData($data) {

        if (! array_key_exists('path-parameters', $data)) {
            $data['path-parameters'] = [];
        }

        if (! array_key_exists('stub-parameters', $data)) {
            $data['stub-parameters'] = [];
        }

        if (! array_key_exists('file-parameters', $data)) {
            $data['file-parameters'] = [];
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

    /**
     * Get the default file extension for the file to be created.
     *
     * @return string
     */
    protected function getDefaultFileExtension()
    {
        return 'php';
    }

    /**
     * Removes "special characters" from a string
     *
     * @param $str
     *
     * @return string
     */
    protected function removeSpecialChars($str)
    {
        // remove everything that is NOT a character or digit
        $str = preg_replace('/[^A-Za-z0-9]/', '', $str);

        return $str;
    }

}
