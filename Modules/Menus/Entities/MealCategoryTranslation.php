<?php

namespace Modules\Menus\Entities;

use Illuminate\Database\Eloquent\Model;


class MealCategoryTranslation extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $table = 'meal_category_translations';

    public $timestamps = false;
}
