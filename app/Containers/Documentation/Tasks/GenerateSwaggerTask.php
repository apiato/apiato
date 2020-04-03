<?php

namespace App\Containers\Documentation\Tasks;

use App\Containers\Documentation\Traits\DocsGeneratorTrait;
use App\Ship\Parents\Tasks\Task;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Class GenerateSwaggerTask.
 *
 * @author M. Mert Yildiran <mehmetmertyildiran@gmail.com>
 */
class GenerateSwaggerTask extends Task
{
    use DocsGeneratorTrait;

    /**
     * @param $type
     * @param $console
     *
     * @return  mixed
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     * @throws \Symfony\Component\Process\Exception\LogicException
     * @throws \Symfony\Component\Process\Exception\ProcessFailedException
     */
    public function run($type, $console)
    {
        $path = $this->getDocumentationPath($type);

        $exe = $this->getSwaggerConverter();

        $app_path = './app';
        $apidoc_json = '/apidoc.json';
        copy($this->getJsonFilePath($type).$apidoc_json, $app_path.$apidoc_json);

        $command = $exe . ' ' . "-v -f '.*\.php$' -i {$app_path} -o {$path}/swagger";

        $process = new Process($command);

        // execute the command
        $process->run();

        unlink($app_path.$apidoc_json);

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // echo the output
        $console->info('[' . $type . '] ' . $command);
        $console->info('Result: ' . $process->getOutput());

        // return the past to that generated documentation
        return $this->getFullApiUrl($type).'/swagger/swagger.json';
    }

}
