<?php

namespace Apiato\Core\Exceptions;

use Apiato\Core\Abstracts\Transformers\Transformer;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class InvalidTransformerException.
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class InvalidTransformerException extends Exception
{

    public $httpStatusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'Transformers must extended the ' . Transformer::class . ' class.';

}
