<?php

namespace Modules\Accounts\Http\Controllers\Api;

use App\Traits\ApiTrait;
use Illuminate\Routing\Controller;
use Nwidart\Modules\Facades\Module;

class BaseController extends Controller
{
    use ApiTrait;

    protected $class;
    protected $module;
    protected $module_name;

    public function __construct() {
        if(is_null($this->module_name)) {
            $this->module = Module::find((new $this->class)?->getTable());
            $this->module_name = $this->module->getLowerName() ;
        }
    }

    /**
     * Validates the given request.
     *
     * @param string $requestClass The name of the request class to be validated.
     * @param \Illuminate\Http\Request $requestObject The request object to be validated.
     *
     * @return array|null The validated request data.
     */
    public function validationAction($requestClass): array|null
    {
        return isset($requestClass) && class_exists($requestClass) ?
            app($requestClass)->validated() : request()->validate(app($requestClass)->rules());
    }
}
