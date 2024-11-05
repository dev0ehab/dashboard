<?php

namespace Modules\Users\Http\Requests;

use Modules\Accounts\Http\Requests\BaseAuthModelRequest;

class UserRequest extends BaseAuthModelRequest
{
    protected $table = 'users';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
        ]);
    }
}
