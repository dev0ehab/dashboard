<?php

namespace Modules\Countries\Http\Filters;

use App\Http\Filters\BaseFilters;

class CityFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'name',
        'state_id',
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
     * Filter the query by a given state id.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function stateId($value)
    {
        if ($value) {
            return $this->builder->where('state_id', $value);
        }

        return $this->builder;
    }
}
