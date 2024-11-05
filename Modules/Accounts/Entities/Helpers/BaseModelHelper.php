<?php

namespace Modules\Accounts\Entities\Helpers;

trait BaseModelHelper
{
    // Getters & Setters

    /**
     * The model image url.
     *
     * @return string
     */
    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl('images');
    }


    /**
     * The model cover url.
     *
     * @return string
     */
    public function getCoverAttribute()
    {
        return $this->getFirstMediaUrl('covers');
    }


    /**
     * The model images url.
     *
     * @return string
     */
    public function getImagesAttribute()
    {
        return $this->getMedia('images');
    }


}
