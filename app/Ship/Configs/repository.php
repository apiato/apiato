<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Repository Pagination
    |--------------------------------------------------------------------------
    |
    */
    'pagination' => [

        'limit' => env('PAGINATION_LIMIT_DEFAULT', 15),

         // if enabled it allows users to skip pagination by passing `?limit=0`.
        'skip' => env('PAGINATION_SKIP', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Fractal Presenter Config
    |--------------------------------------------------------------------------
    |
    | Available serializers:
    |    * ArraySerializer
    |    * DataArraySerializer
    |    * JsonApiSerializer
    |
    */
    'fractal'    => [
        'params'     => [
            'include' => 'include',
        ],
        'serializer' => League\Fractal\Serializer\DataArraySerializer::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Config
    |--------------------------------------------------------------------------
    |
    */
    'cache'      => [
        /*
         |--------------------------------------------------------------------------
         | Cache Status
         |--------------------------------------------------------------------------
         |
         | Enable or disable cache
         |
         */
        'enabled'    => env('ELOQUENT_QUERY_CACHE', false),

        /*
         |--------------------------------------------------------------------------
         | Cache Minutes
         |--------------------------------------------------------------------------
         |
         | Time of expiration cache
         |
         */
        'minutes'    => env('ELOQUENT_QUERY_CACHE_TIME', 30),

        /*
         |--------------------------------------------------------------------------
         | Cache Repository
         |--------------------------------------------------------------------------
         |
         | Instance of Illuminate\Contracts\Cache\Repository
         |
         */
        'repository' => 'cache',

        /*
          |--------------------------------------------------------------------------
          | Cache Clean Listener
          |--------------------------------------------------------------------------
          |
          |
          |
          */
        'clean'      => [

            /*
              |--------------------------------------------------------------------------
              | Enable clear cache on repository changes
              |--------------------------------------------------------------------------
              |
              */
            'enabled' => true,

            /*
              |--------------------------------------------------------------------------
              | Actions in Repository
              |--------------------------------------------------------------------------
              |
              | create : Clear Cache on create Entry in repository
              | update : Clear Cache on update Entry in repository
              | delete : Clear Cache on delete Entry in repository
              |
              */
            'on'      => [
                'create' => true,
                'update' => true,
                'delete' => true,
            ],
        ],

        'params'  => [

            /*
            |--------------------------------------------------------------------------
            | Skip Cache Params
            |--------------------------------------------------------------------------
            |
            |
            | Ex: http://prettus.local/?search=lorem&skipCache=true
            |
            */
            'skipCache' => 'skipCache',
        ],

        /*
        |--------------------------------------------------------------------------
        | Methods Allowed
        |--------------------------------------------------------------------------
        |
        | methods cacheable : all, paginate, find, findByField, findWhere, getByCriteria
        |
        | Ex:
        |
        | 'only'  =>['all','paginate'],
        |
        | or
        |
        | 'except'  =>['find'],
        */
        'allowed' => [
            'only'   => null,
            'except' => null,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Criteria Config
    |--------------------------------------------------------------------------
    |
    | Settings of request parameters names that will be used by Criteria
    |
    */
    'criteria'   => [
        /*
        |--------------------------------------------------------------------------
        | Accepted Conditions
        |--------------------------------------------------------------------------
        |
        | Conditions accepted in consultations where the Criteria
        |
        | Ex:
        |
        | 'acceptedConditions'=>['=','like']
        |
        | $query->where('foo','=','bar')
        | $query->where('foo','like','bar')
        |
        */
        'acceptedConditions' => [
            '=',
            'like',
        ],
        /*
        |--------------------------------------------------------------------------
        | Request Params
        |--------------------------------------------------------------------------
        |
        | Request parameters that will be used to filter the query in the repository
        |
        | Params :
        |
        | - search : Searched value
        |   Ex: http://prettus.local/?search=lorem
        |
        | - searchFields : Fields in which research should be carried out
        |   Ex:
        |    http://prettus.local/?search=lorem&searchFields=name;email
        |    http://prettus.local/?search=lorem&searchFields=name:like;email
        |    http://prettus.local/?search=lorem&searchFields=name:like
        |
        | - filter : Fields that must be returned to the response object
        |   Ex:
        |   http://prettus.local/?search=lorem&filter=id,name
        |
        | - orderBy : Order By
        |   Ex:
        |   http://prettus.local/?search=lorem&orderBy=id
        |
        | - sortedBy : Sort
        |   Ex:
        |   http://prettus.local/?search=lorem&orderBy=id&sortedBy=asc
        |   http://prettus.local/?search=lorem&orderBy=id&sortedBy=desc
        |
        */
        'params'             => [
            'search'       => 'search',
            'searchFields' => 'searchFields',
            'orderBy'      => 'orderBy',
            'sortedBy'     => 'sortedBy',
            'filter'       => 'l5_filter', // we will override the filter in apiato.
            'with'         => 'l5_with' // use `include` instead.
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Generator Config
    |--------------------------------------------------------------------------
    |
    */
    'generator'  => [
        'basePath'      => env('SRC_PATH'),
        'rootNamespace' => env('ROOT_NAMESPACE').'\\',
        'paths'         => [
            'models'       => 'Entities',
            'repositories' => 'Repositories',
            'interfaces'   => 'Repositories',
            'transformers' => 'Transformers',
            'presenters'   => 'Presenters',
        ],
    ],
];
