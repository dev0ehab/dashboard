<?php

namespace Modules\Accounts\Entities;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Accounts\Entities\Helpers\AuthModelHelper;
use Modules\Accounts\Entities\Relations\AuthModelRelation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Accounts\Entities\Scopes\AuthModelScope;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AuthModel extends Authenticatable implements HasMedia
{
    use Notifiable, AuthModelHelper, AuthModelScope, HasApiTokens, InteractsWithMedia, SoftDeletes, AuthModelRelation;

    public const AuthType = 'email';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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
            'phone_verified_at' => 'datetime',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function getResource()
    {
        return new JsonResource($this);
    }

}
