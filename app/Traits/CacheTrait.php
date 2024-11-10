<?php


namespace App\Traits;

use Illuminate\Support\Facades\Redis;
use Str;




trait CacheTrait
{


    /**
     * @param $key
     * @param $value
     * @param int $minutes
     * @return mixed
     */
    public function setCache($key, $value)
    {
        return Redis::set($key, json_encode($value));
    }


    /**
     * @param $key
     * @return mixed
     */
    public function getCache($key)
    {
        return json_decode(Redis::get($key));
    }


    /**
     * @param $key
     * @return mixed
     */
    public function forgetCache($key)
    {
        return Redis::forget($key);
    }


    /**
     * @param $key
     * @return mixed
     */
    public function flushCache($key)
    {
        return Redis::flush();
    }


    /**
     * @param $key
     * @return mixed
     */
    public function hasCache($key)
    {
        return Redis::exists($key);
    }


    /**
     * @param $key
     * @return mixed
     */
    public function removeModelCache($class, $id = null)
    {
        $generated_class = Str::replace('\\', '\\\\', $class);
        $keys = Redis::keys("$generated_class::index*");

        foreach ($keys as $key) {
            preg_match('/::(.*)$/', $key, $matches);
            if (isset($matches[1])) {
                Redis::del("$class::$matches[1]");
            }
        }

        if ($id) {
            Redis::del("$class::show-$id");
        }
    }

}
