<?php

namespace Modules\Settings\Entities;

use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;
use Laraeast\LaravelSettings\Models\Setting as BaseSettingModel;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends BaseSettingModel implements HasMedia
{
    use InteractsWithMedia, HasUploader;

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
        'key', 'value', 'locale'
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

        $this->addMediaCollection('slider_video')->singleFile();

        $this->addMediaCollection('about_video')->singleFile();
    }
}
