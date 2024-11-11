<?php

namespace Modules\Settings\Repositories;

use Laraeast\LaravelSettings\Facades\Settings;
use Modules\Accounts\Contracts\Repositories\BaseModelRepository;
use Modules\Settings\Entities\Setting;

class SettingRepository extends BaseModelRepository
{

    protected $class = Setting::class;
    private $files = [
        'logo',
        'favicon',
        'loginLogo',
        'loginBackground',

    ];

    /**
     * Get index models as a collection.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index($paginated = false)
    {
        return $this->class::first();
    }

    /**
     * Update the specified model with the given data.
     *
     *
     * @param \Illuminate\Database\Eloquent\Model $model The model instance to be updated.
     * @param array $data An associative array of data to update the model with.
     * @return \Illuminate\Database\Eloquent\Model The updated model instance.
     */
    public function update($model, array $data)
    {
        foreach (collect($data)->except(array_merge(['_method'], $this->files)) as $key => $value) {
            Settings::set($key, $value);
        }

        foreach ($this->files as $file) {
            if (isset($data[$file])) {
                Setting::getImage($file)->clearMediaCollection($file);
                Setting::getImage($file)->addMediaFromRequest($file)->toMediaCollection($file);
            }
        }

        return $model;
    }
}
