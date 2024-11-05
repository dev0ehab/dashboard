<?php

namespace Modules\Contactuses\Repositories;

use Modules\Accounts\Contracts\Repositories\BaseModelRepository;
use Modules\Contactuses\Entities\Contactus;
use Modules\Contactuses\Http\Filters\ContactusFilter;

class ContactusRepository extends BaseModelRepository
{
    protected $class = Contactus::class;
    protected $filter = ContactusFilter::class;




    /**
     * Create a new model instance.
     *
     * If the model has a image, cover, or images attribute, it will be added to the model's media collection.
     *
     * @param array $data The data to create a new model instance.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        $data = [
            'name' => user() ? user()->name : $data['name'],
            'email' => user() ? user()->email : $data['email'],
            'phone' => user() ? user()->phone : $data['phone'],
            'message' => $data['message'],
        ];

        $model = $this->class::create($data);

        return $model;
    }



}
