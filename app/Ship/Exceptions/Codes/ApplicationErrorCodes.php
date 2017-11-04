<?php

namespace App\Ship\Exceptions\Codes;

/**
 * Class ApplicationErrorCodes
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class ApplicationErrorCodes
{
    /**
     * The Application Errors defined by Apiato
     * Apiato reserves the error codes 000000 - 099999 for itself.
     */
    const BASE_GENERAL_ERROR = [
        'code' => 1001,
        'title' => 'An unknown error.',
        'description' => 'Something unexpected happend.',
    ];
    const BASE_INTERNAL_ERROR = [
        'code' => 1002,
        'title' => '',
        'description' => '',
    ];
    const BASE_NOT_IMPLEMENTED = [
        'code' => 1003,
        'title' => '',
        'description' => '',
    ];
    const BASE_CONTAINER_MISSING = [
        'code' => 1010,
        'title' => '',
        'description' => '',
    ];
    const BASE_CLASS_MISSING = [
        'code' => 1011,
        'title' => '',
        'description' => '',
    ];
    const BASE_METHOD_MISSING = [
        'code' => 1012,
        'title' => '',
        'description' => '',
    ];
    const BASE_CONFIGURATION_GENERAL_ERROR = [
        'code' => 1020,
        'title' => '',
        'description' => '',
    ];
    const BASE_CONFIGURATION_WRONG = [
        'code' => 1021,
        'title' => '',
        'description' => '',
    ];
    const AUTHENTICATION_GENERAL_ERROR = [
        'code' => 1100,
        'title' => '',
        'description' => '',
    ];
    const AUTHENTICATION_NOT_ALLOWED = [
        'code' => 1101,
        'title' => '',
        'description' => '',
    ];
    const AUTHENTICATION_INVALID_CREDENTIALS = [
        'code' => 1102,
        'title' => '',
        'description' => '',
    ];
    const AUTHENTICATION_TOKEN_ERROR = [
        'code' => 1110,
        'title' => '',
        'description' => '',
    ];
    const AUTHENTICATION_TOKEN_EXPIRED = [
        'code' => 1111,
        'title' => '',
        'description' => '',
    ];
    const AUTHENTICATION_TOKEN_BLACKLISTED = [
        'code' => 1112,
        'title' => '',
        'description' => '',
    ];
    const AUTHORIZATION_FAILED = [
        'code' => 1120,
        'title' => '',
        'description' => '',
    ];
    const AUTHORIZATION_NOT_AUTHORIZED = [
        'code' => 1121,
        'title' => '',
        'description' => '',
    ];
    const AUTHORIZATION_INSUFFICIENT_ROLE = [
        'code' => 1122,
        'title' => '',
        'description' => '',
    ];
    const REQUEST_GENERAL_ERROR = [
        'code' => 1300,
        'title' => '',
        'description' => '',
    ];
    const REQUEST_TOKEN_MISSING = [
        'code' => 1301,
        'title' => '',
        'description' => '',
    ];
    const REQUEST_TOKEN_EXPIRED = [
        'code' => 1302,
        'title' => '',
        'description' => '',
    ];
    const REQUEST_HEADER_JSON_MISSING = [
        'code' => 1310,
        'title' => '',
        'description' => '',
    ];
    const RESPONSE_GENERAL_ERROR = [
        'code' => 1350,
        'title' => '',
        'description' => '',
    ];
    const RESPONSE_UNSUPPORTED_SERIALIZER = [
        'code' => 1351,
        'title' => '',
        'description' => '',
    ];
    const RESPONSE_UNKNOWN_INCLUDE = [
        'code' => 1352,
        'title' => '',
        'description' => '',
    ];
    const RESOURCE_GENERAL_ERROR = [
        'code' => 1400,
        'title' => '',
        'description' => '',
    ];
    const RESOURCE_CREATE_FAILED = [
        'code' => 1401,
        'title' => '',
        'description' => '',
    ];
    const RESOURCE_UPDATE_FAILED = [
        'code' => 1402,
        'title' => '',
        'description' => '',
    ];
    const RESOURCE_DELETE_FAILED = [
        'code' => 1403,
        'title' => '',
        'description' => '',
    ];
    const RESOURCE_NOT_FOUND = [
        'code' => 1404,
        'title' => '',
        'description' => '',
    ];
    const VALIDATION_GENERAL_ERROR = [
        'code' => 1500,
        'title' => '',
        'description' => '',
    ];
    const VALIDATION_FAILED = [
        'code' => 1501,
        'title' => '',
        'description' => '',
    ];
    const VALIDATION_WRONG_ID = [
        'code' => 1502,
        'title' => '',
        'description' => '',
    ];
    const USER_GENERAL_ERROR = [
        'code' => 1800,
        'title' => '',
        'description' => '',
    ];
    const USER_ALREADY_EXISTS = [
        'code' => 1801,
        'title' => '',
        'description' => '',
    ];
    const USER_ALREADY_VERIFIED = [
        'code' => 1802,
        'title' => '',
        'description' => '',
    ];
    const USER_NOT_VERIFIED = [
        'code' => 1803,
        'title' => '',
        'description' => '',
    ];
    const TEST_GENERAL_ERROR = [
        'code' => 1900,
        'title' => '',
        'description' => '',
    ];
    const TEST_ENDPOINT_MISSING = [
        'code' => 1901,
        'title' => '',
        'description' => '',
    ];

    /**
     * Add your custom application error codes here
     */



}