<?php

namespace Jcshoww\PHPDictionary;

use Exception;
use InvalidArgumentException;

/**
 * Base dictionary class
 * 
 * @author jcshoww
 * 
 * @package Jcshoww\PHPDictionary
 */
abstract class Dictionary
{
    /**
     * Get dictionary values.
     * 
     * @return array
     */
    abstract public static function getValues(): array;

    /**
     * Get dictionary data in object style formatting (for API).
     * 
     * @return array
     */
    public static function getObjectFormatted(): array
    {
        $values = static::getValues();
        $result = [];
        foreach ($values as $key => $value) {
            $result[] = ['id' => $key, 'value' => $value];
        }

        return $result;
    }

    /**
     * Get dictionary keys.
     * 
     * @return array
     */
    public static function getKeys(): array
    {
        return array_keys(static::getValues());
    }

    /**
     * Get values count.
     * 
     * @return int
     */
    public static function count(): int
    {
        return count(static::getKeys());
    }

    /**
     * Get value by key.
     * 
     * @param mixed $key
     * 
     * @return mixed
     */
    public static function getValueByKey($key)
    {
        if (is_null($key)) {
            return $key;
        }
        $value = isset(static::getValues()[$key]) ? static::getValues()[$key] : null;
        if ($value === null) {
            return $value;
        }

        return $value;
    }

    /**
     * Get values by list of keys.
     * 
     * @param array $keys
     * 
     * @return array
     * @throws Exception
     */
    public static function getValueByKeys(array $keys): array
    {
        self::validateKeys($keys);
        return array_filter(static::getValues(), static function ($value, $key) use ($keys) {
            return in_array($key, $keys) === true;
        });
    }

    /**
     * Get values without listed keys
     *
     * @param array $keys
     *
     * @return array
     */
    public static function getValueWithoutKeys(array $keys): array
    {
        self::validateKeys($keys);
        return array_filter(static::getValues(), static function ($value, $key) use ($keys) {
            return in_array($key, $keys) === false;
        });
    }

    /**
     * Check if key exists.
     * 
     * @param int $key
     * 
     * @return bool
     */
    public static function exist(int $key): bool
    {
        return in_array($key, static::getKeys(), true);
    }

    /**
     * Validate passed keys.
     * 
     * @param array $keys
     * 
     * @throws InvalidArgumentException
     */
    protected static function validateKeys(array $keys): void
    {
        foreach ($keys as $key) {
            if (array_key_exists($key, static::getValues()) === false) {
                throw new InvalidArgumentException('Invalid keys.');
            }
        }
    }
}
