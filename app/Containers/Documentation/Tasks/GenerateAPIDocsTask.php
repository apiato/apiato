<?php

namespace App\Containers\Documentation\Tasks;

use App\Containers\Documentation\Traits\DocsGeneratorTrait;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Config\Repository as Config;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Class GenerateAPIDocsTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GenerateAPIDocsTask extends Task
{

    use DocsGeneratorTrait;

    /**
     * @var  \Illuminate\Config\Repository
     */
    private $config;

    /**
     * GenerateApiDocJsDocsTask constructor.
     *
     * @param \Illuminate\Config\Repository $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @param $type
     *
     * @return  mixed
     */
    public function run($type, $console)
    {
        $path = $this->getDocumentationPath($type);

        $exe = $this->getExecutable();

        // the actual command that needs to be executed:
        $command = $exe . ' ' . "-c {$this->getJsonFilePath($type)} {$this->getEndpointFiles($type)}-i app -o {$path}";

        // execute the command
        ($process = new Process($command))->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // echo the output
        $console->info('[' . $type . '] ' . $command);
        $console->info('Result: ' . $process->getOutput());

        // return the past to that generated documentation
        return $this->getFullApiUrl($type);
    }

}
