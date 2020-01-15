<?php

namespace Apiato\Core\Traits\TestsTraits\PhpUnit;

use Illuminate\Http\UploadedFile;

/**
 * Class TestsUploadHelperTrait
 *
 * * Tests helper for uploading files.
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
trait TestsUploadHelperTrait
{

    /**
     * @param        $fileName
     * @param        $stubDirPath
     * @param string $mimeType
     * @param null   $size
     *
     * @return  \Illuminate\Http\UploadedFile
     */
    public function getTestingFile($fileName, $stubDirPath, $mimeType = 'text/plain', $size = null)
    {
        $file = $stubDirPath . $fileName;

        return new UploadedFile($file, $fileName, $mimeType, $size, null, true); // null = null | $testMode = true
    }

    /**
     * @param        $imageName
     * @param        $stubDirPath
     * @param string $mimeType
     * @param null   $size
     *
     * @return  \Illuminate\Http\UploadedFile
     */
    public function getTestingImage($imageName, $stubDirPath, $mimeType = 'image/jpeg', $size = null)
    {
        return $this->getTestingFile($imageName, $stubDirPath, $mimeType, $size);
    }

}
