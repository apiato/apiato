<?php

namespace Apiato\Core\Commands;

use Apiato\Core\Transformers\ComposerTransformer;
use App\Ship\Parents\Commands\ConsoleCommand;
use Dotenv\Exception\InvalidPathException;
use Exception;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Spatie\Fractal\Fractal;
use Spatie\Fractalistic\ArraySerializer;

/**
 * Class FindContainerDependenciesCommand
 * Parses all files in the Container. This is needed due to the implemented apiato calls.
 * It supports both $this->call(PATH/TO/FILE,... (by parsing imports)
 * as well as $Apiato::call('CONTAINER@FUNC',[args]...
 *
 * @author Fabian Widmann <fabian.widmann@gmail.com>
 */
class ListContainerDependenciesCommand extends ConsoleCommand
{

    protected $signature = 'apiato:list:dependencies {containerPath}';

    protected $description = 'Lists all dependencies from the given container to other containers.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $containerPath = $this->argument('containerPath');

        $this->info('Searching for dependencies in container: ' . $containerPath);
        $input = $this->ask('Remove own container from listings? (y/n)');

        $filterOwnContainer = false;
        if (isset($input) && $input == 'y') {
            $filterOwnContainer = true;
        }

        $fileContainerMatch = $this->getDependencies($containerPath, $filterOwnContainer);
        if (count($fileContainerMatch) > 0) {
            $this->info('Found dependencies:');
            $this->info($this->prettyPrintArray($fileContainerMatch));

            $input = $this->ask('Display Container author and description from the composer.json?(y/n)');
            if (isset($input) && $input == 'y') {
                // $fileContainerMatch structure:
                // imports
                //    containerName(s)
                //         File(s)
                $matches = array_unique(array_keys(array_merge(...array_values($fileContainerMatch))));
                foreach ($matches as $match) {
                    $this->info($this->prettyPrintArray($this->getComposerInformation($match)));
                }
            }
        } else {
            $this->info('No dependencies found.');
        }
    }

    /**
     * Utility print function that takes an array and outputs it by applying the given indent. Each array found will be printed recursively with indent+indentmodifier.
     *
     * @param     $arr
     * @param int $indent
     * @param int $indentModifier
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    private function prettyPrintArray($arr, $indent = 0, $indentModifier = 4)
    {
        if (!is_array($arr)) {
            return $arr;
        }

        $string = "";

        foreach ($arr as $key => $value) {
            $string = $string . str_repeat(" ", $indent) . "[" . $key . "]" . ": ";

            if (is_array($value)) {
                $string .= PHP_EOL . $this->prettyPrintArray($value, $indent + $indentModifier) . PHP_EOL;
            } else if (is_string($value) || settype($item, 'string') !== false || (is_object($value) && method_exists($value, '__toString'))){
                $string .= $value . PHP_EOL;
            }
            else {
                throw new \InvalidArgumentException('Current value cannot be converted to string: value=' . $value);
            }
        }
        return $string;
    }

    /**
     * Get composer information by decoding the json and applying the ComposerTransformer.
     *
     * @param $containerName
     * @return array|string
     */
    private function getComposerInformation($containerName)
    {
        $composerFile = 'app/Containers/' . $containerName . '/composer.json';

        try {
            $content = file_get_contents($composerFile);

            if (isset($content)) {
                $json = \GuzzleHttp\json_decode($content);
                return Fractal::create($json, ComposerTransformer::class, ArraySerializer::class)->toArray();
            }
        } catch (Exception $e) {
            return 'No composer.json found in path: ' . $composerFile;
        }
    }

    /**
     * Extracts the content of a file  and find all containers by finding all containers in App\Containers\$containerName\*
     *
     * @param $filePath string - path to the file
     * @return null | array of containers
     */
    private function getContainerFromUseStatement($filePath)
    {
        $content = file_get_contents($filePath);

        // is the containername alphanumeric?
        preg_match_all('/use App\\\\Containers\\\\(?P<containers>[a-zA-Z\d]*)\\\\/', $content, $matches);
        $ret = [];

        if (isset($matches['containers'])) {
            $ret['containers'] = array_unique($matches['containers']);
        }

        return $ret;
    }

    /**
     * Extracts the content of a file  and find all containers by finding all containers in App\Containers\$containerName\*
     *
     * @param $filePath string - path to the file
     * @return null | array of containers
     */
    private function getContainerFromApiatoCall($filePath)
    {
        $content = file_get_contents($filePath);
        //ignores everything that doesnt begin with spaces or tabs.
        //group 1: ignore lines that start with '//' or '/*', preg match into containers
        //group 2: get containers
        //group 3: parse functions (starting with one letter followed by alphanumeric letters
        //group 4: arguments inside of the square brackets
        //Examples @ http://www.phpliveregex.com/p/m8p
        $pattern = "/^([^\/\/]*|[^\/\*]*)Apiato::call\('(?P<containers>.*?)@([?P<functions>a-zA-Z][a-zA-Z\d]*?)',.*?\[(?P<args>.*?)]/m";
        preg_match_all($pattern, $content, $matches);
        $ret = [];

        if (isset($matches['containers'])) {
            $ret['containers'] = array_unique($matches['containers']);
        }
        //todo: add functions and arguments if needed currently unsupported. They are stored in the group 'functions' and 'args'.
        return $ret;
    }

    /**
     * Iterates through the given path recursively to obtain
     *  1) all used containers of the given container
     *  2) an array that contains the containers as keys and all files using it as value.
     *
     * @param      $path - to the container
     * @param bool $filterOwnContainer
     *
     * @return array - [$usedContainers, $filesInContainers]
     * @throws InvalidPathException
     */
    private function getDependencies($path, $filterOwnContainer = false)
    {
        $ownContainerName = explode('/', explode('app/Containers/', $path)[1])[0];

        if (!file_exists($path)) {
            throw new InvalidPathException('Given path does not exist: path=' . $path);
        }

        $recursiveIteratorIterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
        $useStatements = [];
        $filesInContainers = [];

        foreach ($recursiveIteratorIterator as $file) {
            if (!$file->isDir()) {
                $apiatoCalls = $this->getContainerFromApiatoCall($file->getPathName());
                $imports = $this->getContainerFromUseStatement($file->getPathName());

                if (isset($apiatoCalls['containers'])) {
                    if ($filterOwnContainer) {
                        $apiatoCalls['containers'] = array_diff($apiatoCalls['containers'], [$ownContainerName]);
                    }

                    foreach ($apiatoCalls['containers'] as $container) {
                        $filesInContainers['apiatoCalls'][$container][] = $file->getPathName();
                    }
                }

                if (isset($imports['containers'])) {
                    if ($filterOwnContainer) {
                        $imports['containers'] = array_diff($imports['containers'], [$ownContainerName]);
                    }

                    foreach ($imports['containers'] as $container) {
                        $filesInContainers['imports'][$container][] = $file->getPathName();
                    }
                }
            }
        }

        return $filesInContainers;
    }

}
