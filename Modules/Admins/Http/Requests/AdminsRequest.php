<?php

namespace Modules\Admins\Http\Requests;

use Modules\Accounts\Http\Requests\BaseAuthModelRequest;

class AdminsRequest extends BaseAuthModelRequest
{
    protected $table = 'admins';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'role_id' => ['required', 'exists:roles,id'],
        ]);
    }
}
