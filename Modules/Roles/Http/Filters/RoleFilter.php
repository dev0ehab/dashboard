<?php

namespace Modules\Roles\Http\Filters;

use App\Http\Filters\BaseFilters;

class RoleFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'name',
    ];

    /**
     * Filter the query by a given name.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function name($value)
    {
        if ($value) {
            return $this->builder->where('name', 'like', "%$value%");
        }

        return $this->builder;
    }

    /**
     * Filter the query to include users by phone.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function only_trashed($value)
    {
        if ($value) {
            return $this->builder->onlyTrashed();
        }

        return $this->builder;
    }
}
