<?php

namespace App\Ship\Parents\Repositories;

use Illuminate\Support\Facades\Config;
use Prettus\Repository\Contracts\CacheableInterface as PrettusCacheable;
use Prettus\Repository\Criteria\RequestCriteria as PrettusRequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository as PrettusRepository;
use Prettus\Repository\Traits\CacheableRepository as PrettusCacheableRepository;
use Request;

/**
 * Class Repository.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Repository extends PrettusRepository implements PrettusCacheable
{

    use PrettusCacheableRepository;

    /**
     * This function relies on the convention.
     * Conventions:
     *    - Repository name should be same like it's model name (model: Foo -> repository: FooRepository).
     *    - If the container contains Models with names different than the container name, the repository class must
     *          set `$container='ContainerName'` property for this function to work properly
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        // 1_ get the full namespace of the child class who's extending this class.
        // 2_ remove the namespace and keep the class name
        // 3_ remove the word Repository from the class name
        // 4_ check if the container name is set on the repository to indicate that the
        //    model has different name than the container holding it
        // 5_ build the namespace of the Model based on the conventions

        $fullName = get_called_class();
        $className = substr($fullName, strrpos($fullName, '\\') + 1);
        $classOnly = str_replace('Repository', '', $className);
        $container = isset($this->container) ? $this->container : $classOnly;
        $modelNamespace = 'App\Containers\\' . $container . '\\Models\\' . $classOnly;

        return $modelNamespace;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(PrettusRequestCriteria::class));
    }

    /**
     * Paginate the response
     *
     * Apply pagination to the response. Use ?limit= to specify the amount of entities in the response.
     * The client can request all data (skipping pagination) by applying ?limit=0 to the request, if
     * PAGINATION_SKIP is set to true.
     *
     * @param null   $limit
     * @param array  $columns
     * @param string $method
     *
     * @return  mixed
     */
    public function paginate($limit = null, $columns = ['*'], $method = "paginate")
    {
        // the priority is for the function parameter, if not available then take
        // it from the request if available and if not keep it null.
        $limit = $limit ? : Request::get('limit');

        // check, if skipping pagination is allowed and the requested by the user
        if(Config::get('repository.pagination.skip') && $limit == "0") {
            return parent::all($columns);
        }

        return parent::paginate($limit, $columns, $method);
    }
}
