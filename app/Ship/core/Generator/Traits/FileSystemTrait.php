<?php

namespace Apiato\Core\Generator\Traits;

use Exception;

trait FileSystemTrait
{

    /**
     * Determine if the file already exists.
     *
     * @param $path
     *
     * @return bool
     */
    protected function alreadyExists($path)
    {
        return $this->fileSystem->exists($path);
    }

    /**
     * @param $filePath
     * @param $stubContent
     *
     * @return mixed
     */
    public function generateFile($filePath, $stubContent)
    {
        return $this->fileSystem->put($filePath, $stubContent);
    }

    /**
     * If path is for a directory, create it otherwise do nothing
     *
     * @param $path
     */
    public function createDirectory($path)
    {
        if ($this->alreadyExists($path)) {

            $this->printErrorMessage($this->fileType . ' already exists');

            // the file does exist - return but NOT exit
            return;
        }

        try {

            if (!$this->fileSystem->isDirectory(dirname($path))) {
                $this->fileSystem->makeDirectory(dirname($path), 0777, true, true);
            }

        } catch (Exception $e) {
            $this->printErrorMessage('Could not create ' . $path);
        }
    }

}
