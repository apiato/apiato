<?php

declare(strict_types=1);

namespace App\Ship\Parents\Repositories;

use Apiato\Core\Repositories\Repository as AbstractRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 *
 * @extends AbstractRepository<TModel>
 *
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class Repository extends AbstractRepository
{
}
