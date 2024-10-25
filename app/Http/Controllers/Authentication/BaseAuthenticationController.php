<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Routing\Controller;
use Nwidart\Modules\Facades\Module;

class BaseAuthenticationController extends Controller
{

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
    public function validationAction($requestClass, $requestObject): array|null
    {
        return isset($requestClass) && class_exists($requestClass) ?
            app($requestClass)->validated($requestObject) : request()->validate(app($requestClass)->rules());
    }
}
