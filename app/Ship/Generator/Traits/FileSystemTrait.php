<?php

namespace App\Ship\Generator\Traits;

use Exception;

trait FileSystemTrait
{

    /**
     * Determine if the file already exists.
     *
     * @return bool
     */
    protected function alreadyExists($path)
    {
        return $this->fileSystem->exists($path);
    }

    /**
     * @return  mixed
     */
    public function generateFile()
    {
        return $this->fileSystem->put($this->filePath, $this->stubContent);
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

            exit();
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
