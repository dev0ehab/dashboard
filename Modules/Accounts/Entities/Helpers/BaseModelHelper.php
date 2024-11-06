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
        return $this->getMediaResource('images')->first();
    }


    /**
     * The model cover url.
     *
     * @return string
     */
    public function getCoverAttribute()
    {
        return $this->getMediaResource('covers')->first();
    }


    /**
     * The model images url.
     *
     * @return string
     */
    public function getImagesAttribute()
    {
        return $this->getMediaResource('images')->first();
    }


}
