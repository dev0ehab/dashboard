<?php

namespace Modules\Accounts\Contracts\Repositories;


use Modules\Accounts\Contracts\Interfaces\CrudsInterface;
use Modules\Accounts\Contracts\Interfaces\SoftDeleteInterface;

class BaseModelRepository implements CrudsInterface, SoftDeleteInterface
{
    protected $class;
    protected $filter;


    public function __construct($class)
    {
        $this->class = $class;
        $this->filter = new $this->filter();
    }


    public function index()
    {
        return $this->class::filter($this->filter)->paginate(request('perPage'));
    }

    public function create(array $data)
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
                $model->addMediaFromRequest($image)->toMediaCollection('covers');
            }
        }

        return $model;
    }


    public function show($model)
    {
        return $this->class::findOrFail($model);
    }


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


    public function delete($model)
    {
        $model->delete();
    }



    public function trashed()
    {
        return $this->class::onlyTrashed()->filter($this->filter)->paginate(request('perPage'));
    }


    public function forceDelete($model)
    {
        return $model->forceDelete();
    }


    public function restore($model)
    {
        return $model->restore();
    }

}
