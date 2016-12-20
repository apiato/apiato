<?php

namespace App\Port\Transformer\Abstracts;

use App\Containers\Authorization\Traits\UserAuthorizationTrait;
use League\Fractal\TransformerAbstract as FractalTransformerAbstract;

/**
 * Class Transformer.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Transformer extends FractalTransformerAbstract
{
    use UserAuthorizationTrait; // TODO: this depend on the existence of the Authorization Container.
}
