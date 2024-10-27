<?php

namespace Modules\Accounts\Entities\Helpers;

trait AuthModelHelper
{
    // Getters & Setters

    /**
     * The Admin profile image url.
     *
     * @return string
     */
    public function getAvatarAttribute()
    {
        return $this->getFirstMediaUrl('avatars');
    }


    public function getNameAttribute()
    {
        return $this->f_name . ' ' . $this->l_name;
    }


    // Methods
    /**
     * Check if the given auth type has been verified.
     *
     * @param string $auth_type
     * @return bool
     */
    public function hasVerifiedAuth(string $auth_type): bool
    {
        return (bool) $this->{"{$auth_type}_verified_at"};
    }


}
