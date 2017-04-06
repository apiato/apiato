<?php

namespace App\Containers\Generator\Traits;

trait PrinterTrait
{

    public function printStartedMessage()
    {
        $this->printInfoMessage('> Generating (' . $this->fileName . ') in (' . $this->containerName . ') Container.');
    }

    /**
     * @void
     */
    public function printFinishedMessage()
    {
        $this->printInfoMessage($this->fileType . ' generated successfully.');
    }

    /**
     * @param $message
     */
    public function printErrorMessage($message)
    {
        $this->error($message);
    }

    /**
     * @param $message
     */
    public function printInfoMessage($message)
    {
        $this->info($message);
    }

}
