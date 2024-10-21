<?php

namespace Modules\Settings\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Laraeast\LaravelSettings\Facades\Settings;

class StaticPagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'policy' => Settings::locale(app()->getLocale())->get('policy'),
            'terms' => Settings::locale(app()->getLocale())->get('terms'),
        ];
    }
}
