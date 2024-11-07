<?php


namespace App\Traits;

use Cache;



trait CacheTrait
{


    /**
     * @param $key
     * @param $value
     * @param int $minutes
     * @return mixed
     */
    public function setCache($key, $value, $minutes = null)
    {
        return Cache::put($key, $value, $minutes);
    }


    /**
     * @param $key
     * @return mixed
     */
    public function getCache($key)
    {
        return Cache::get($key);
    }


    /**
     * @param $key
     * @return mixed
     */
    public function forgetCache($key)
    {
        return Cache::forget($key);
    }


    /**
     * @param $key
     * @return mixed
     */
    public function flushCache($key)
    {
        return Cache::flush();
    }


    /**
     * @param $key
     * @return mixed
     */
    public function hasCache($key)
    {
        return Cache::has($key);
    }

}
