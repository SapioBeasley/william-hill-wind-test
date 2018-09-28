<?php

namespace App\Lib;

/**
 * Interface CacheInterface
 * @package App\Lib
 */
interface CacheInterface
{

    /**
     * @param $key
     * @return mixed
     */
    public function forget($key);

    /**
     * @param $key
     * @param $minutes
     * @param $callback
     * @return mixed
     */
    public function remember($key, $minutes, $callback);

    /**
     * @param $key
     * @return mixed
     */
    public function has($key);
}