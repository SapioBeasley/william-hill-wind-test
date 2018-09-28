<?php

namespace App\Lib;

/**
 * Class CacheDecorator
 * @package App\Lib
 */
class CacheDecorator implements CacheInterface
{
    /**
     * @param $key
     * @return mixed|void
     */
    public function forget($key)
    {
        \Cache::forget($key);
    }

    /**
     * @param $key
     * @param $minutes
     * @param $callback
     * @return mixed
     */
    public function remember($key, $minutes, $callback)
    {
        return \Cache::remember($key, $minutes, $callback);
    }

    public function has($key)
    {
        return \Cache::has($key);
    }
}