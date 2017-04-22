<?php

namespace App\Ship\Generator\Traits;

trait PrinterTrait
{

    public function printStartedMessage($containerName, $fileName)
    {
        $this->printInfoMessage('> Generating (' . $fileName . ') in (' . $containerName . ') Container.');
    }

    /**
     * @void
     */
    public function printFinishedMessage($type)
    {
        $this->printInfoMessage($type . ' generated successfully.');
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
