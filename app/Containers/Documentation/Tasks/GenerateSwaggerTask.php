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
        // little hack to move the apidoc.json file to the /app directory in order to be seen by apidoc-swagger
        // since the command doesn't support passing custom path.
        $app_path = 'app';
        $apidoc_json = '/apidoc.json';
        copy($this->getJsonFilePath($type) . $apidoc_json, $app_path . $apidoc_json);

        $command = [
            $this->getSwaggerConverter(),
            // executable parameters
            "-v",
            "",
            "-f",
            "'.*\.php$'",
            "-i",
            $app_path,
            "-o",
            "{$this->getDocumentationPath($type)}/swagger"
        ];

        $process = new Process($command);

        // execute the command
        $process->run();

        // delete the apidoc.json file after executing the command since it's no longer needed.
        unlink($app_path . $apidoc_json);

        if (!$process->isSuccessful()) {
            $console->error('Error Output: ' . $process->getOutput());
            throw new ProcessFailedException($process);
        }

        // echo the output
        $console->info('[' . $type . '] ' . implode (' ', $command));
        $console->info('Output: ' . $process->getOutput());

        // return the past to that generated documentation
        return $this->getFullApiUrl($type).'/swagger/swagger.json';
    }

}
