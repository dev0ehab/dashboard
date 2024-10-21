<?php

namespace Modules\Admins\Listeners;

use Illuminate\Support\Facades\Storage;
use Modules\Admins\Events\ResetPasswordCreated;


class SendResetPasswordCode
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param ResetPasswordCreated $event
     * @return void
     */
    public function handle(ResetPasswordCreated $event)
    {
        $event->resetPasswordCode->user->sendSmsResetPasswordNotification($event->resetPasswordCode->code);

        /* @deprecated */
        Storage::disk('public')->append(
            'resetPassword.txt',
            "The reset password code for phone {$event->resetPasswordCode->username} is {$event->resetPasswordCode->code} generated at " . now()->toDateTimeString() . "\n"
        );
    }
}
