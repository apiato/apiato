<?php

namespace App\Containers\Generator\Traits;

trait ParserTrait
{

    /**
     * @return  mixed
     */
    public function parsePathStructure()
    {
        $path = $this->pathStructure;

        // replace strings in the paths string
        $path = str_replace('{container-name}', $this->containerName, $path);
        $path = str_replace('*', $this->fileName, $path);

        return $path;
    }

}
