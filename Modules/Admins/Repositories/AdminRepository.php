<?php

namespace Modules\Admins\Repositories;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Modules\Admins\Entities\Admin;
use Modules\Admins\Http\Filters\AdminFilter;
use Modules\Contracts\CrudRepository;

class AdminRepository implements CrudRepository
{
    /**
     * @var AdminFilter
     */
    private $filter;

    /**
     * AdminRepository constructor.
     *
     * @param AdminFilter $filter
     */
    public function __construct(AdminFilter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * Get all clients as a collection.
     *
     * @return LengthAwarePaginator
     */
    public function all()
    {
        return Admin::where('email', '!=', 'admin@demo.com')->where('email', '!=', 'root@demo.com')->filter($this->filter)->paginate(request('perPage'));
    }

    /**
     * Save the created model to storage.
     *
     * @param array $data
     * @return Admin
     */
    public function create(array $data)
    {
        $admin = Admin::create($data);

        $admin->addRoles([$data['role_id']]);

        $admin->setVerified();

        $admin->addMediaFromRequest('avatar')->toMediaCollection('avatars');

        return $admin;
    }

    /**
     * Display the given client instance.
     *
     * @param mixed $model
     * @return Admin
     */
    public function find($model)
    {
        if ($model instanceof Admin) {
            return $model;
        }

        return Admin::findOrFail($model);
    }

    /**
     * Update the given client in the storage.
     *
     * @param mixed $model
     * @param array $data
     * @return Model
     */
    public function update($model, array $data)
    {
        $admin = $this->find($model);

        $admin->update($data);

        if (isset($data['avatar'])) {
            $admin->clearMediaCollection('avatars');
            $admin->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }

        return $admin;
    }

    /**
     * Delete the given client from storage.
     *
     * @param mixed $model
     * @return void
     * @throws Exception
     */
    public function delete($model)
    {
        $this->find($model)->delete();
    }

    /**
     * @param Admin $admin
     * @return Admin
     */
    public function block(Admin $admin)
    {
        $admin->block()->save();

        return $admin;
    }

    /**
     * @param Admin $admin
     * @return Admin
     */
    public function unblock(Admin $admin)
    {
        $admin->unblock()->save();

        return $admin;
    }
}
