<?php

namespace App\Containers\Documentation\Contracts;

/**
 * Interface  ApiTypeInterface
 *
 * @author   Mahmoud Zalt  <mahmoud@zalt.me>
 */
interface ApiTypeInterface
{
    public function getDocumentationPath();

    public function getJsonFilePath();

    public function getType();

    public function getUrl();
}
