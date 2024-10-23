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
    public function getAvatar()
    {
        return $this->getFirstMediaUrl('avatars');
    }

    /**
     * @return Admin
     */
    public function block()
    {
        return $this->forceFill(['blocked_at' => Carbon::now()]);
    }

    /**
     * @return Admin
     */
    public function unblock()
    {
        return $this->forceFill(['blocked_at' => null]);
    }

    public function sendVerificationCode(): void
    {
        if (!$this || $this->email_verified_at) {
            throw ValidationException::withMessages([
                'phone' => [trans('admins::verification.verified')],
            ]);
        }

        $verification = Verification::updateOrCreate([
            'verifiable_id' => $this->id,
            'verifiable_type' => get_class($this),
            'verficiation_type' => '',
            'verficiation_value' => $this->phone,
        ], [
            'code' => random_int(1111, 9999),
        ]);

        if (env("SMS_TEST_MODE") == 0) {
            // event(new VerificationCreated($verification));
        }
    }
}
