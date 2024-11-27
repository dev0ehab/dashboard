<?php

namespace Modules\Accounts\Entities\Helpers;

use BackedEnum;
use Illuminate\Http\Exceptions\HttpResponseException;

trait AuthModelHelper
{
    // Getters & Setters

    /**
     * The auth model profile image url.
     *
     * @return string
     */
    public function getAvatarAttribute()
    {
        return $this->getMediaResource('avatars')->first();
    }


    /**
     * Get the full name attribute by concatenating the first name and last name.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->f_name . ' ' . $this->l_name;
    }

    /**
     * Block the auth model.
     *
     * @return self
     */
    public function block()
    {
        return $this->forceFill(['blocked_at' => now()]);
    }

    /**
     * Un-block the auth model.
     *
     * @return self
     */
    public function unblock()
    {
        return $this->forceFill(['blocked_at' => null]);
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

    public function hasPermission(
        string|array|BackedEnum $permission,
        mixed $team = null,
        bool $requireAll = false
    ): bool {
        $response = [
            'success' => false,
            'data' => [],
            'message' => trans("messages.User does not have any of the necessary access rights"),
        ];
        throw new HttpResponseException(response()->json(
            $response
        ));

    }
}
