<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Storage;
use App\Events\VerificationCreated;


class SendVerificationCode
{
    private $auth_model;
    private $auth_type;
    private $code;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(VerificationCreated $event)
    {
        $this->auth_model = $event->verification->verifiable;
        $this->auth_type = request()->get('auth_type');
        $this->code = $event->verification->code;
    }

    /**
     * Handle the event.
     *
     * @param VerificationCreated $event
     * @return void
     */
    public function handle(VerificationCreated $event)
    {
        // dd($event->verification->verifiable);
        // if (!$event->verification->verifiable->hasVerifiedEmail()) {
        //     $event->verification->user->sendSmsVerificationNotification($event->verification->phone, $event->verification->code);
        // }

        switch ($this->auth_type) {
            case 'email':
                $this->sendEmailNotification();
                break;
            case 'phone':
                $this->sendSmsNotification();
                break;
            default:
                break;
        }

        /* @deprecated */
        Storage::disk('public')->append(
            'verification.txt',
            "The verification code for phone {$event->verification->phone} is {$event->verification->code} generated at " . now()->toDateTimeString() . "\n"
        );
    }



    private function sendEmailNotification()
    {
        // dd("email");
        // $model->notify(new SendResetPasswordCodeNotification($code));
    }

    private function sendSmsNotification()
    {
        // dd("phone");
        // $model->notify(new SendResetPasswordCodeNotification($code));
    }

}
