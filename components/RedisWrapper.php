<?php

namespace components;

use Predis\Client;
use Predis\ClientException;

class RedisWrapper
{
    /**
     * @var Client|null
     */
    private static $connection = null;

    /**
     * @return Client
     */
    public static function init()
    {
        if (is_null(self::$connection)) {
            self::$connection = new Client();
        }

        return self::$connection;
    }

    /**
     * @param $key string
     *
     * @return string
     */
    public static function get($key)
    {
        return self::init()->get($key);
    }

    /**
     * @param $key
     * @param null $default
     *
     * @return mixed
     */
    public static function getDecoded($key, $default = null)
    {
        $res = self::get($key);
        $res = json_decode($res, true);

        return $res ?? $default;
    }

    /**
     * @param $key string
     * @param $value mixed
     * @param $lifeTime bool|int
     *
     * @return bool
     */
    public static function set($key, $value, $lifeTime = false): bool
    {
        try {

            if (is_array($value)) {
                $value = json_encode($value);
            }

            self::init()->set($key, $value);

            if ($lifeTime !== false) {
                self::init()->expire($key, $lifeTime);
            }

        } catch (ClientException $exception) {
            return false;
        }

        return true;
    }

    /**
     * @param $key array|string
     *
     * @return bool
     */
    public static function delete($key): bool
    {
        try {
            self::init()->del($key);
        } catch (ClientException $exception) {
            return false;
        }

        return true;
    }

}