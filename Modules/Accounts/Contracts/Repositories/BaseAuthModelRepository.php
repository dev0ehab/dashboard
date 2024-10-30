<?php

namespace Modules\Accounts\Contracts\Repositories;


use Modules\Accounts\Contracts\Interfaces\BlockInterface;
use Modules\Accounts\Contracts\Interfaces\CrudsInterface;
use Modules\Accounts\Contracts\Interfaces\SoftDeleteInterface;

class BaseAuthModelRepository implements CrudsInterface, SoftDeleteInterface, BlockInterface
{
    protected $class;
    protected $filter;
    protected $has_roles;


    public function __construct($class)
    {
        $this->class = $class;
        $this->filter = new $this->filter();
        $this->has_roles = method_exists($this->class, 'roles');
    }


    public function index()
    {
        return $this->class::filter($this->filter)->paginate(request('perPage'));
    }

    public function create(array $data)
    {
        $model = $this->class::create($data);

        if ($this->has_roles) {
            $model->attachRoles([$data['role_id']]);
        }

        if (isset($data['avatar'])) {
            $model->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }
        return $model;
    }


    public function show($id, $withTrashed = false)
    {
        return $this->class::when($withTrashed, fn($q) => $q->withTrashed())->findOrFail($id);
    }


    public function update($model, array $data)
    {
        $model->update($data);

        if ($this->has_roles) {
            $model->syncRoles([$data['role_id']]);
        }

        if (isset($data['avatar'])) {
            $model->clearMediaCollection('avatars');
            $model->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }

        return $this->class;
    }


    public function delete($model)
    {
        $model->forceFill([
            "email" => null
        ])->save();

        $model->delete();
    }



    public function block($model)
    {
        $model->block()->save();

        return $model;
    }


    public function unblock($model)
    {
        $model->unblock()->save();

        return $model;
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
