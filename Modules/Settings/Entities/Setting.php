<?php

namespace Modules\Settings\Entities;

use App\Traits\MediaTrait;
use Laraeast\LaravelSettings\Facades\Settings;
use Laraeast\LaravelSettings\Models\Setting as BaseSettingModel;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends BaseSettingModel implements HasMedia
{
    use InteractsWithMedia, MediaTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
        'locale'
    ];

    /**
     * Define the media collections.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')->singleFile();

        $this->addMediaCollection('favicon')->singleFile();

        $this->addMediaCollection('loginLogo')->singleFile();

        $this->addMediaCollection('loginBackground')->singleFile();

    }



    public static function get($key)
    {
        return Settings::get($key, $default);
    }
}
