<?php

namespace App\Ship\Exceptions\Codes;
use App\Ship\Exceptions\InternalErrorException;
use Exception;
use ReflectionClass;

/**
 * Class ErrorCodeManager
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class ErrorCodeManager
{
    /**
     * @param array $error
     *
     * @return mixed
     */
    public static function getCode(array $error)
    {
        return self::getKeyFromArray($error, 'code', 0);
    }

    /**
     * @param array $error
     *
     * @return mixed
     */
    public static function getTitle(array $error)
    {
        return self::getKeyFromArray($error, 'title', '');
    }

    /**
     * @param array $error
     *
     * @return mixed
     */
    public static function getDescription(array $error)
    {
        return self::getKeyFromArray($error, 'description', '');
    }

    /**
     * Returns the value for a given key in the array or a default value
     *
     * @param array $error
     * @param       $key
     * @param       $default
     *
     * @return mixed
     */
    private static function getKeyFromArray(array $error, $key, $default)
    {
        return isset($error[$key]) ? $error[$key] : $default;
    }

    /**
     * Returns all "defined" CodeTables
     *
     * @return array
     */
    public static function getCodeTables()
    {
        $codeTables = [
            ApplicationErrorCodesTable::class,
            CustomErrorCodesTable::class,
        ];

        return $codeTables;
    }

    /**
     * Get all arrays for this one error code table
     *
     * @param $codeTable
     *
     * @return array
     * @throws InternalErrorException
     */
    public static function getErrorsForCodeTable($codeTable)
    {
        try {
            $class = new $codeTable;
        }
        catch (Exception $exception) {
            throw new InternalErrorException();
        }

        // now we need to get all errors (i.e., constants) from this class!
        $reflectionClass = new ReflectionClass($class);
        $constants = $reflectionClass->getConstants();

        return $constants;
    }

    /**
     * Get all errors across all defined error code tables
     *
     * @return array
     */
    public static function getErrorsForCodeTables()
    {
        $tables = self::getCodeTables();

        $result = [];

        foreach ($tables as $table) {
            $errors = self::getErrorsForCodeTable($table);
            $result = array_merge($result, $errors);
        }

        return $result;
    }
}