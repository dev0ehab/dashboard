<?php

namespace Modules\Accounts\Contracts\Repositories;


use Modules\Accounts\Contracts\Interfaces\BlockInterface;
use Modules\Accounts\Contracts\Interfaces\CrudsInterface;
use Modules\Accounts\Contracts\Interfaces\SoftDeleteInterface;
use Modules\Accounts\Events\ChangePasswordEvent;
use Modules\Accounts\Events\CreateAuthModelEvent;

class BaseAuthModelRepository implements CrudsInterface, SoftDeleteInterface, BlockInterface
{
    protected $class;
    protected $filter;
    protected $has_roles;


    /**
     * BaseAuthModelRepository constructor.
     *
     * Initializes the filter and checks if the class has roles.
     */
    public function __construct()
    {
        $this->filter = new $this->filter();
        $this->has_roles = method_exists($this->class, 'roles');
    }


    /**
     * Get index models as a collection.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return $this->class::filter($this->filter)->paginate(request('perPage'));
    }

    /**
     * Save the created model to storage.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */

    public function store(array $data)
    {
        $model = $this->class::create($data);
        if ($this->has_roles) {
            $model->addRoles([$data['role_id']]);
        }

        if (isset($data['avatar'])) {
            $model->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }

        event(new CreateAuthModelEvent((string) get_class($model), (string) $model->id, (string) $data['password']));

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
     * Update the specified model in storage.
     *
     * @param \Illuminate\Database\Eloquent\Model $model The model instance to update.
     * @param array $data The data to update the model with, including optional avatar and password fields.
     * @return \Illuminate\Database\Eloquent\Model The updated model instance.
     *
     * This method updates the model with the given data. If the model has roles, it synchronizes them
     * with the provided role ID. It also handles the avatar media collection and triggers a password
     * change event if a new password is provided.
     */
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

        if (isset($data['password'])) {
            event(new ChangePasswordEvent((string) get_class($model), (string) $model->id, (string) $data['password']));
        }

        return $model;
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
        $model->forceFill([
            "email" => null,
            "phone" => null
        ])->save();

        $model->delete();
    }



    /**
     * Block the specified model.
     *
     * @param \Illuminate\Database\Eloquent\Model $model The model instance to block.
     * @return \Illuminate\Database\Eloquent\Model The blocked model instance.
     *
     * This method sets the model's blocked status and saves the changes.
     */
    public function block($model)
    {
        $model->block()->save();

        return $model;
    }


    /**
     * Unblock the specified model.
     *
     * @param \Illuminate\Database\Eloquent\Model $model The model instance to unblock.
     * @return \Illuminate\Database\Eloquent\Model The unblocked model instance.
     *
     * This method sets the model's blocked status to false and saves the changes.
     */
    public function unblock($model)
    {
        $model->unblock()->save();

        return $model;
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
