<?php


namespace App\Traits;


trait MiddlewareTrait
{

    protected $un_active_middlewares = [];
    protected $active_middlewares = [];

    protected $middlewares = [
        'index',
        'show',
        'store',
        'update',
        'delete',
        'restore',
        'forceDelete',
        'block',
        'unblock',
        'status',
    ];

    public function getMiddlewares()
    {
        if (user()) {
            $this->middleware("auth:sanctum");
        }

        $middlewares = $this->active_middlewares ?: array_diff($this->middlewares, $this->un_active_middlewares);


        array_map(function ($middleware) {
            return $this->middleware("permission:$middleware" . "_" . "$this->permission")->only([$middleware]);
        }, $middlewares);

    }

}
