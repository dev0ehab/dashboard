<?php

namespace Modules\Subscriptions\Repositories;

use Modules\Accounts\Contracts\Repositories\BaseModelRepository;
use Modules\Subscriptions\Entities\Plan;
use Modules\Subscriptions\Http\Filters\PlanFilter;

class PlanRepository extends BaseModelRepository
{
    protected $class = Plan::class;
    protected $filter = PlanFilter::class;



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


        $model = parent::store($data);

        foreach ($data['meals'] as $meal) {
            $model->meals()->create($meal);
        }

        foreach ($data['versions'] as $version) {
            $version['price'] = $version['meal_price_per_day'] + $version['delivery_price_per_day'] * $version['number_of_days'];
            $model->versions()->create($version);
        }

        return $model;
    }



    /**
     * Update the specified model with the given data.
     *
     * This method updates the model with the provided data array and manages media
     * collections for 'image', 'cover', and 'images'. If a new image, cover, or set
     * of images are provided in the data, the corresponding media collection is cleared
     * and updated with the new media.
     *
     * @param \Illuminate\Database\Eloquent\Model $model The model instance to be updated.
     * @param array $data An associative array of data to update the model with.
     * @return \Illuminate\Database\Eloquent\Model The updated model instance.
     */
    public function update($model, array $data)
    {
       parent::update($model, $data);

       if (isset($data['meals'])) {
           $model->meals()->delete();
           foreach ($data['meals'] as $meal) {
               $model->meals()->create($meal);
           }
       }

       if (isset($data['versions'])) {
           $model->versions()->delete();
           foreach ($data['versions'] as $version) {
               $model->versions()->create($version);
           }
       }
    }
}
