<?php

namespace Modules\Accounts\Entities;

use App\Traits\Filterable;
use App\Traits\MediaTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Accounts\Entities\Helpers\BaseModelHelper;
use Modules\Accounts\Entities\Relations\BaseModelRelation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BaseModel extends Model implements HasMedia
{
    use BaseModelHelper, InteractsWithMedia, BaseModelRelation , Filterable , MediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
        ];
    }

    protected function getResource()
    {
        return new JsonResource($this);
    }

}
