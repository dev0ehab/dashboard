<?php

namespace Modules\Admins\Repositories;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Modules\Admins\Entities\Admin;
use Modules\Admins\Entities\User;
use Modules\Admins\Http\Filters\UserFilter;
use Modules\Contracts\CrudRepository;

class UserRepository implements CrudRepository
{
    /**
     * @var UserFilter
     */
    private $filter;

    /**
     * UserRepository constructor.
     *
     * @param UserFilter $filter
     */
    public function __construct(UserFilter $filter)
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
        return User::filter($this->filter)->paginate(request('perPage'));
    }

    /**
     * Save the created model to storage.
     *
     * @param array $data
     * @return Admin
     */
    public function create(array $data)
    {
        $user = User::create($data);

        // add role to user
        $user->addRole($user->user_type->role);

        $user->setVerified();

        $user->addAllMediaFromTokens();

        return $user;
    }

    /**
     * Display the given user instance.
     *
     * @param mixed $model
     * @return User
     */
    public function find($model)
    {
        if ($model instanceof User) {
            return $model;
        }

        return User::findOrFail($model);
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
        $user = $this->find($model);
        // dd($user->user_type->role->id);

        $user->update($data);

        $user->syncRoles([$user->user_type->role]);


        $user->addAllMediaFromTokens();

        return $user;
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
     * get trashed users
     * @return LengthAwarePaginator
     */
    public function trashed()
    {
        return User::onlyTrashed()->filter($this->filter)->paginate(request('perPage'));
    }


    /**
     * hard delete
     * @param mixed $model
     * @throws Exception
     */
    public function forceDelete($model)
    {
        $this->find($model)->forceDelete();
    }


    /**
     * restore user
     * @param mixed $model
     * @throws Exception
     */
    public function restore($model)
    {
        $this->find($model)->restore();
    }


    /**
     * @param User $user
     * @return User
     */
    public function block(User $user)
    {
        $user->block()->save();

        return $user;
    }

    /**
     * @param User $user
     * @return User
     */
    public function unblock(User $user)
    {
        $user->unblock()->save();

        return $user;
    }

}
