<?php

namespace Modules\Accounts\Entities;

use App\Casts\DateTimeCast;
use App\Traits\Filterable;
use App\Traits\MediaTrait;
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
    use Notifiable, AuthModelHelper, AuthModelScope, HasApiTokens, InteractsWithMedia, SoftDeletes, AuthModelRelation, Filterable, MediaTrait;

    public const AuthType = 'email';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [];

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
     * Define the media collections.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatars')
            ->useFallbackUrl('https://www.gravatar.com/avatar/' . md5($this->email) . '?d=mm')
            ->singleFile();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => DateTimeCast::class,
            'updated_at' => DateTimeCast::class,
            'password' => 'hashed',
        ];
    }

    protected function getResource()
    {
        return new JsonResource($this);
    }

}
