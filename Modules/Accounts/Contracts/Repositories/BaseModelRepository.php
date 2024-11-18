<?php

namespace Modules\Accounts\Contracts\Repositories;


use Modules\Accounts\Contracts\Interfaces\CrudsInterface;
use Modules\Accounts\Contracts\Interfaces\SoftDeleteInterface;

class BaseModelRepository implements CrudsInterface, SoftDeleteInterface
{
    protected $class;
    protected $filter;


    /**
     * BaseModelRepository constructor.
     *
     * Initializes the filter class.
     */
    public function __construct()
    {
        if ($this->filter) {
            $this->filter = new $this->filter();
        }
    }


    /**
     * Get index models as a collection.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index($paginated = true)
    {
        return $this->class::filter($this->filter)
            ->when($paginated, fn($q) => $q->paginate(request('perPage')))
            ->when(!$paginated, fn($q) => $q->get());
    }

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
        $model = $this->class::create($data);

        if (isset($data['image'])) {
            $model->addMediaFromRequest('image')->toMediaCollection('images');
        }

        if (isset($data['cover'])) {
            $model->addMediaFromRequest('cover')->toMediaCollection('covers');
        }

        if (isset($data['images'])) {
            foreach ($data['images'] as $image) {
                $model->addMediaFromRequest($image)->toMediaCollection('images');
            }
        }

        return $model;
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param bool $withTrashed
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function show($id, $withTrashed = false)
    {
        return $this->class::when($withTrashed, fn($q) => $q->withTrashed())->findOrFail($id);
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
        $model->update($data);

        if (isset($data['image'])) {
            $model->clearMediaCollection('images');
            $model->addMediaFromRequest('image')->toMediaCollection('images');
        }

        if (isset($data['cover'])) {
            $model->clearMediaCollection('covers');
            $model->addMediaFromRequest('cover')->toMediaCollection('covers');
        }

        if (isset($data['images'])) {
            foreach ($data['images'] as $image) {
                $model->clearMediaCollection('images');
                $model->addMediaFromRequest($image)->toMediaCollection('images');
            }
        }

        return $this->class;
    }

    /**
     * Delete the given model from storage.
     *
     * @param \Illuminate\Database\Eloquent\Model $model The model instance to delete.
     * @return void
     *
     * This method deletes the model and clears its email and phone attributes to prevent
     * accidental exposure of sensitive data.
     */
    public function delete($model)
    {
        $model->delete();
    }


    /**
     * Force delete the specified model.
     *
     * @param \Illuminate\Database\Eloquent\Model $model The model instance to delete permanently.
     *
     * This method deletes the model permanently without regard for the model's
     * block status and saves the changes.
     */
    public function forceDelete($model)
    {
        return $model->forceDelete();
    }


    /**
     * Restore the specified model.
     *
     * @param \Illuminate\Database\Eloquent\Model $model The model instance to restore.
     *
     * This method restores the model from the "deleted" state and saves the changes.
     */
    public function restore($model)
    {
        return $model->restore();
    }

}
