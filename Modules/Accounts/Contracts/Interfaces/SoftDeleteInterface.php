<?php

namespace Modules\Accounts\Contracts\Interfaces;

interface SoftDeleteInterface
{

    /**
     * forceDelete model .
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function forceDelete($model);


    /**
     * restore model .
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function restore($model);



}
