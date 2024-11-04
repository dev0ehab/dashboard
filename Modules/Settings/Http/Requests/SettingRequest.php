<?php

namespace Modules\Settings\Http\Requests;

use Modules\Accounts\Http\Requests\BaseModelRequest;

class SettingRequest extends BaseModelRequest
{
    protected $module_name = 'settings';
    protected $table = 'settings';

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10000'],
        ];
    }


    /**
     * This function is called after validation passes.
     *
     * If you need to do additional validation, override this function.
     *
     * @return void
     */
    protected function additionalValidation()
    {
        //
    }
}
