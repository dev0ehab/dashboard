<?php

namespace Modules\Admins\Entities\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\ValidationException;
use Modules\Admins\Entities\ResetPasswordCode;
use Modules\Admins\Entities\User;
use Modules\Admins\Entities\Verification;
use Modules\Admins\Events\VerificationCreated;

trait UserHelpers
{
    /**
     * Determine whether the user type is admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return ($this->type === User::ADMIN_TYPE);
    }

    /**
     * Set the user type.
     *
     * @return $this
     */
    public function setType($type)
    {
        if (in_array($type, array_keys(trans('admins::users.types')))) {
            $this->forceFill([
                'type' => $type,
            ])->save();
        }

        return $this;
    }

    /**
     * Set the user type.
     *
     * @return $this
     */
    public function setVerified(): self
    {
        $this->forceFill([
            'email_verified_at' => Carbon::now(),
        ])->save();

        return $this;
    }

    /**
     * Determine whether the user can access dashboard.
     *
     * @return bool
     */
    public function canAccessDashboard()
    {
        return $this->isAdmin() || $this->can_access;
    }

    /**
     * The user profile image url.
     *
     * @return bool
     */
    public function getAvatar()
    {
        return $this->getFirstMediaUrl('avatars');
    }

    /**
     * @return User
     */
    public function block()
    {
        return $this->forceFill(['blocked_at' => Carbon::now()]);
    }

    /**
     * @return User
     */
    public function unblock()
    {
        return $this->forceFill(['blocked_at' => null]);
    }

    /**
     * send verification sms to user
     * @param $phone
     * @param $code
     */
    public function sendSmsVerificationNotification($phone, $code): void
    {
        $greetings = trans('admins::auth.register.verification.greeting', [
            'user' => $this->name,
        ]);
        $line = trans('admins::auth.register.verification.line', [
            'code' => $code,
        ]);
        $footer = trans('admins::auth.register.verification.footer');
        $salutation = trans('admins::auth.register.verification.salutation', [
            'app' => Config::get('app.name'),
        ]);
        $site = config('admins.sms_site');
        $api_key = config('admins.sms_api_key');
        $title = config('admins.sms_title');
        $text = $greetings . ' ' . $line . ' ' . $footer . ' ' . $salutation;
        $sentto = $phone;
        $report = 1;
        $sms_lang = 2;
        $local = app()->getLocale();
        if ($local === 'tr') {
            $sms_lang = 1;
        } elseif ($local === 'en') {
            $sms_lang = 0;
        }
        $body = array("api_key" => $api_key, "title" => $title, "text" => $text, "sentto" => $sentto, "report" => $report, "sms_lang" => $sms_lang);
        $json = json_encode($body);
        $ch = curl_init($site);
        $header = array('Content-Type: application/json');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
    }

    /**
     * send reset password sms
     * @param $code
     */
    public function sendSmsResetPasswordNotification($code): void
    {
        $greetings = trans('admins::auth.emails.forget-password.greeting', [
            'user' => $this->name,
        ]);
        $line = trans('admins::auth.emails.forget-password.line', [
            'code' => $code,
            'minutes' => ResetPasswordCode::EXPIRE_DURATION / 60,
        ]);
        $footer = trans('admins::auth.emails.forget-password.footer');
        $salutation = trans('admins::auth.emails.forget-password.salutation', [
            'app' => Config::get('app.name'),
        ]);
        $site = config('admins.sms_site');
        $api_key = config('admins.sms_api_key');
        $title = config('admins.sms_title');
        $text = $greetings . $line . $footer . $salutation;
        $sentto = $this->phone;
        $report = 1;
        $sms_lang = 2;
        $local = app()->getLocale();
        if ($local === 'tr') {
            $sms_lang = 1;
        } elseif ($local === 'en') {
            $sms_lang = 0;
        }
        $body = array("api_key" => $api_key, "title" => $title, "text" => $text, "sentto" => $sentto, "report" => $report, "sms_lang" => $sms_lang);
        $json = json_encode($body);
        $ch = curl_init($site);
        $header = array('Content-Type: application/json');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
    }

    /**
     * Send the phone number verification code.
     *
     * @param null $test_mode
     * @return void
     * @throws ValidationException
     */
    public function sendVerificationCode($test_mode = null): void
    {
        if (!$this || $this->email_verified_at) {
            throw ValidationException::withMessages([
                'phone' => [trans('admins::verification.verified')],
            ]);
        }

        $verification = Verification::updateOrCreate([
            'user_id' => $this->id,
            'phone' => $this->phone,
        ], [
            'code' => random_int(1111, 9999),
        ]);

        if ($test_mode != 1 || !$test_mode) {
            event(new VerificationCreated($verification));
        }
    }
}
