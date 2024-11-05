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
    protected $translated_module_name;

    /**
     * Initializes the controller by resolving the current module based on the class given in
     * the $class property. The module name is then stored in the $module_name property.
     * If the $module_name property is already set, the method does nothing.
     */
    public function __construct()
    {
        if (is_null($this->module_name)) {
            $this->module = Module::find((new $this->class)?->getTable());
            $this->module_name = $this->module->getLowerName();
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
