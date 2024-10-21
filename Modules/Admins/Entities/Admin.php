<?php

namespace Modules\Admins\Entities;

use Modules\Admins\Entities\Scopes\AdminScopes;
use Modules\Admins\Transformers\AdminResource;
use Parental\HasParent;

class Admin extends User
{
    use HasParent, AdminScopes;

    /**
     * Get the class name for polymorphic relations.
     *
     * @return string
     */
    public function getMorphClass()
    {
        return User::class;
    }

    /**
     * Get the default foreign key name for the model.
     *
     * @return string
     */
    public function getForeignKey()
    {
        return 'user_id';
    }

    /**
     * Get the resource for admin type.
     *
     * @return \Modules\Admins\Transformers\AdminResource
     */
    public function getResource()
    {
        return new AdminResource($this);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Admins\Database\factories\AdminFactory::new();
    }
}
