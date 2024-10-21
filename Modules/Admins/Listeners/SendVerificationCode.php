<?php

namespace Modules\Admins\Listeners;

use Illuminate\Support\Facades\Storage;
use Modules\Admins\Events\VerificationCreated;


class SendVerificationCode
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
     * @param VerificationCreated $event
     * @return void
     */
    public function handle(VerificationCreated $event)
    {
        if (!$event->verification->user->hasVerifiedEmail()) {
            $event->verification->user->sendSmsVerificationNotification($event->verification->phone, $event->verification->code);
        }

        /* @deprecated */
        Storage::disk('public')->append(
            'verification.txt',
            "The verification code for phone {$event->verification->phone} is {$event->verification->code} generated at " . now()->toDateTimeString() . "\n"
        );
    }
}
