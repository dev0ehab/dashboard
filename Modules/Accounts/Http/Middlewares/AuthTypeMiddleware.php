<?php

namespace Modules\Accounts\Http\Middlewares;


use Closure;
use Illuminate\Http\Request;
use App\Traits\ApiTrait;
use Nwidart\Modules\Facades\Module;
use Str;
use Symfony\Component\HttpFoundation\Response;

class AuthTypeMiddleware
{
    use ApiTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $url = $request->url();
        $pattern = '/api\/([^\/]+)/';
        if (preg_match($pattern, $url, $matches)) {
            $word = $matches[1];

            $singular = ucfirst($this->isPlural($word) ? Str::singular($word) : $word);
            $plural = ucfirst($this->isPlural($word) ? $word : Str::plural($word));
            $class = "Modules\\$plural\Entities\\$singular";


            if (class_exists($class)) {
                $class = app($class);
                request()->merge([
                    'auth_type' => $request->get('auth_type') ?: get_model_auth_type($class),
                    'table' => $class->getTable(),
                    'module_name' => Module::find($class->getTable())?->getLowerName()
                ]);
            } else {
                return $this->sendError("there is no class {$class}");
            }
        }

        return $next($request);
    }



    function isPlural($word)
    {
        return $word === Str::plural($word) && $word !== Str::singular($word);
    }
}
