<?php

namespace Modules\Deliveries\Http\Controllers\Api;

use Modules\Accounts\Http\Controllers\Api\BaseAuthModelController;
use Modules\Deliveries\Entities\Delivery;
use Modules\Deliveries\Http\Requests\DeliveryRequest;
use Modules\Deliveries\Repositories\DeliveryRepository;
use Modules\Deliveries\Transformers\DeliveryBreifResource;
use Modules\Deliveries\Transformers\DeliveryResource;

class DeliveryController extends BaseAuthModelController
{
    protected $class = Delivery::class;
    protected $form_request = DeliveryRequest::class;
    protected $module_name = 'deliveries';
    protected $permission = 'deliveries';
    protected $repository = DeliveryRepository::class;
    protected $resource = DeliveryResource::class;
    protected $brief_resource = DeliveryBreifResource::class;


    /**
     * Determine if the specified model can be deleted.
     *
     * @param mixed $model The model to check.
     * @return bool True if the model can be deleted, false otherwise.
     */
    protected function canDelete($model): bool
    {
        return true;
    }
}
