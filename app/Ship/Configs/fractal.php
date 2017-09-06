<?php

return [

    /*
     * The default serializer to be used when performing a transformation. It
     * may be left empty to use Fractal's default one. This can either be a
     * string or a League\Fractal\Serializer\SerializerAbstract subclass.
     */
    'default_serializer' => env('API_RESPONSE_SERIALIZER', 'League\Fractal\Serializer\DataArraySerializer'),

    /*
     * The default paginator to be used when performing a transformation. It
     * may be left empty to use Fractal's default one. This can either be a
     * string or a League\Fractal\Paginator\PaginatorInterface subclass.*
     */
    'default_paginator' => '',

    /*
     * League\Fractal\Serializer\JsonApiSerializer will use this value to
     * as a prefix for generated links. Set to `null` to disable this.
     */
    'base_url' => null,

    /*
     * If you wish to override or extend the default Spatie\Fractal\Fractal
     * instance provide the name of the class you want to use.
     */
    'fractal_class' => Spatie\Fractal\Fractal::class,

    'auto_includes' => [

        /*
         * If enabled Fractal will automatically add the includes who's
         * names are present in the `include` request parameter.
         */
        'enabled' => true,

        /*
         * The name of key in the request to where we should look for the includes to include.
         */
        'request_key' => 'include',
    ],
];
