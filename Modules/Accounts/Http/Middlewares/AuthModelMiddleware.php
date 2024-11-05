<?php

namespace Modules\Accounts\Http\Middlewares;


use Closure;
use Illuminate\Http\Request;
use App\Traits\ApiTrait;
use Modules\Accounts\Entities\AuthModel;
use Symfony\Component\HttpFoundation\Response;

class AuthModelMiddleware
{
    use ApiTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $model): Response
    {
        $userModel = strtolower(class_basename(get_class(user() ?: AuthModel::class)));

        if ($userModel !== $model) {
            return $this->sendError("this request is only for {$model}");
        }

        return $next($request);
    }

}
