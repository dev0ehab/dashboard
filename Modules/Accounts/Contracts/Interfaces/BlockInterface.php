<?php

namespace Modules\Accounts\Contracts\Interfaces;

interface BlockInterface
{
    /**
     * block model .
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function block($model);


    /**
     * unblock model .
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function unblock($model);
}
