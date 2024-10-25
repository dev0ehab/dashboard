<?php

namespace Modules\Admins\Entities\Helpers;

use App\Models\Verification;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Modules\Admins\Entities\Admin;

trait AdminHelpers
{
    /**
     * The Admin profile image url.
     *
     * @return string
     */
    public function getAvatarImageAttribute()
    {
        return $this->getFirstMediaUrl('avatars');
    }

    public function sendVerificationCode(): void
    {
        if (!$this || $this->email_verified_at) {
            throw ValidationException::withMessages([
                'phone' => [trans('admins::verification.verified')],
            ]);
        }
    }

    public function hasVerifiedAuth(string $auth_type): bool
    {
        return (bool) $this->{"{$auth_type}_verified_at"};
    }
}
