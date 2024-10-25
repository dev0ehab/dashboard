<?php

namespace Modules\Admins\Entities;

use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Modules\Admins\Entities\Helpers\AdminHelpers;
use Modules\Admins\Entities\Relations\AdminRelations;
use Modules\Admins\Transformers\AdminResource;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Admin extends Authenticatable implements HasMedia, LaratrustUser
{
    use Notifiable, AdminHelpers, HasApiTokens, InteractsWithMedia, HasRolesAndPermissions, SoftDeletes, AdminRelations;

    const AuthType = 'email';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'f_name',
        'l_name',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
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
