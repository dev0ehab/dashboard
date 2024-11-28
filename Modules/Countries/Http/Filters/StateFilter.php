<?php

namespace Modules\Countries\Http\Filters;

use App\Http\Filters\BaseFilters;

class StateFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'name',
        'country_id',
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
     * Filter the query by a given country id.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function countryId($value)
    {
        if ($value) {
            return $this->builder->where('country_id', $value);
        }

        return $this->builder;
    }
}
