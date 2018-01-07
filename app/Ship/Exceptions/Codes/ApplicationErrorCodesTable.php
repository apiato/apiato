<?php

namespace App\Ship\Exceptions\Codes;

use App\Ship\Parents\Exceptions\ErrorCodesTable;

/**
 * Class ApplicationErrorCodesTable
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class ApplicationErrorCodesTable extends ErrorCodesTable
{
    /**
     * The Application Errors defined by Apiato
     * Apiato reserves the error codes 000000 - 099999 for itself.
     *
     * Do not manually change this file, as this will be changed occasionally by Apiato.
     * If you do like to create your own (custom) error codes, please use the
     * App\Ship\Exceptions\Codes\CustomErrorCodesTable class and follow the scheme defined in this class here
     */
    const BASE_GENERAL_ERROR = [
        'code' => 1001,
        'title' => 'Unknown / Unspecified Error.',
        'description' => 'Something unexpected happened.',
    ];
    const BASE_INTERNAL_ERROR = [
        'code' => 1002,
        'title' => 'Internal Error',
        'description' => 'An internal error occurred.',
    ];
    const BASE_NOT_IMPLEMENTED = [
        'code' => 1003,
        'title' => 'Not Implemented',
        'description' => 'This class, method or route is not implemented.',
    ];
    const BASE_CONTAINER_MISSING = [
        'code' => 1010,
        'title' => 'Container Missing',
        'description' => 'The requested container cannot be found.',
    ];
    const BASE_CLASS_MISSING = [
        'code' => 1011,
        'title' => 'Class Missing',
        'description' => 'The requested class cannot be found.',
    ];
    const BASE_METHOD_MISSING = [
        'code' => 1012,
        'title' => 'Method Missing',
        'description' => 'The requested method cannot be found.',
    ];
    const BASE_CONFIGURATION_GENERAL_ERROR = [
        'code' => 1020,
        'title' => 'Configuration Error',
        'description' => 'An unexpected error occurred in the configuration.',
    ];
    const BASE_CONFIGURATION_WRONG = [
        'code' => 1021,
        'title' => 'Wrong Configuration',
        'description' => 'A wrong configuration was found.',
    ];
    const BASE_CONFIGURATION_OAUTH_MISSING = [
        'code' => 1022,
        'title' => 'OAuth Missing',
        'description' => 'OAuth is not installed or not properly configured.',
    ];

    const AUTHENTICATION_GENERAL_ERROR = [
        'code' => 1100,
        'title' => 'General Error',
        'description' => 'A general error occurred during the authentication process.',
    ];
    const AUTHENTICATION_NOT_ALLOWED = [
        'code' => 1101,
        'title' => 'Not Allowed',
        'description' => 'You are not allowed to perform this action.',
    ];
    const AUTHENTICATION_INVALID_CREDENTIALS = [
        'code' => 1102,
        'title' => 'Invalid Credentials',
        'description' => 'The credentials did not match any user.',
    ];
    const AUTHENTICATION_LOGIN_FAILED = [
        'code' => 1103,
        'title' => 'Login Failed',
        'description' => 'The login failed because of various reasons.',
    ];
    const AUTHENTICATION_TOKEN_ERROR = [
        'code' => 1110,
        'title' => 'Token Error',
        'description' => 'Something is wrong with the authentication token.',
    ];
    const AUTHENTICATION_TOKEN_EXPIRED = [
        'code' => 1111,
        'title' => 'Token Expired',
        'description' => 'The authentication token has expired.',
    ];
    const AUTHENTICATION_TOKEN_BLACKLISTED = [
        'code' => 1112,
        'title' => 'Token Blacklisted',
        'description' => 'The authentication token is blacklisted and cannot be used any more.',
    ];
    const AUTHORIZATION_FAILED = [
        'code' => 1120,
        'title' => 'Authorization Failed',
        'description' => 'The application failed to authorize the user',
    ];
    const AUTHORIZATION_NOT_AUTHORIZED = [
        'code' => 1121,
        'title' => 'Not Authorized',
        'description' => 'The user is not authorized.',
    ];
    const AUTHORIZATION_INSUFFICIENT_ROLE = [
        'code' => 1122,
        'title' => 'Insufficient Role',
        'description' => 'The user has an insufficient role to perform the requested operation.',
    ];
    const AUTHORIZATION_UNKNOWN_ROLE = [
        'code' => 1123,
        'title' => 'Unknown Role',
        'description' => 'The role was not found.',
    ];
    const AUTHORIZATION_UNKNOWN_PERMISSION = [
        'code' => 1124,
        'title' => 'Unknown Permission',
        'description' => 'The permission was not found.',
    ];

    const REQUEST_GENERAL_ERROR = [
        'code' => 1300,
        'title' => 'General Error',
        'description' => 'A general error occurred in the context of the request.',
    ];
    const REQUEST_GENERAL_WRONG_METHOD = [
        'code' => 1301,
        'title' => 'Wrong Request Method',
        'description' => 'The endpoint was called with a wrong HTTP Method (e.g., GET instead of POST).',
    ];
    const REQUEST_TOKEN_MISSING = [
        'code' => 1301,
        'title' => 'Token Missing',
        'description' => 'The authorization token is missing.',
    ];
    const REQUEST_TOKEN_EXPIRED = [
        'code' => 1302,
        'title' => 'Token Expired',
        'description' => 'The authorization token has expired.',
    ];
    const REQUEST_REFRESHTOKEN_MISSING = [
        'code' => 1303,
        'title' => 'Refresh-Token Missing',
        'description' => 'The refresh token is missing.',
    ];
    const REQUEST_REFRESHTOKEN_EXPIRED = [
        'code' => 1304,
        'title' => 'Refresh-Token Expired',
        'description' => 'The refresh token has expired.',
    ];
    const REQUEST_HEADER_JSON_MISSING = [
        'code' => 1310,
        'title' => '',
        'description' => '',
    ];
    const REQUEST_HEADER_LANGUAGE_WRONG = [
        'code' => 1311,
        'title' => 'Wrong Accept Language',
        'description' => 'Unknown Accept Language found.',
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

    const PAYMENT_GENERAL_ERROR = [
        'code' => 1700,
        'title' => '',
        'description' => '',
    ];
    const PAYMENT_TRANSACTION_FAILED = [
        'code' => 1701,
        'title' => '',
        'description' => '',
    ];
    const PAYMENT_METHOD_NOT_FOUND = [
        'code' => 1702,
        'title' => '',
        'description' => '',
    ];
    const PAYMENT_ACCOUNT_NOT_FOUND = [
        'code' => 1703,
        'title' => '',
        'description' => '',
    ];
    const PAYMENT_GATEWAY_API_ERROR = [
        'code' => 1704,
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
    const TEST_ENDPOINT_WRONG_DECLARATION = [
        'code' => 1902,
        'title' => '',
        'description' => '',
    ];
}