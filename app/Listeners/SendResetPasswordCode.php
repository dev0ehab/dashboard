<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Storage;
use App\Events\ResetPasswordCreated;


class SendResetPasswordCode
{
    private $auth_model;
    private $auth_type;
    private $code;
    private $verification_value;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ResetPasswordCreated $event)
    {
        $this->auth_model = $event->resetPasswordCode->resetable;
        $this->auth_type = request()->get('auth_type');
        $this->code = $event->resetPasswordCode->code;
        $this->verification_value = $event->resetPasswordCode->verification_value;
    }

    /**
     * Handle the event.
     *
     * @param ResetPasswordCreated $event
     * @return void
     */
    public function handle(ResetPasswordCreated $event)
    {

        switch ($this->auth_type) {
            case 'email':
                $this->sendEmailNotification();
                break;
            case 'phone':
                $this->sendSmsNotification();
                break;
            default:
                # code...
                break;
        }

        /* @deprecated */
        Storage::disk('public')->append(
            'resetPassword.txt',
            "The reset password code for $this->auth_type {$this->verification_value} is {$this->code} generated at " . now()->toDateTimeString() . "\n"
        );
    }


    private function sendEmailNotification()
    {
        // $this->auth_model->notify(new SendResetPasswordCodeNotification($code));
    }

    private function sendSmsNotification()
    {
        // $this->auth_model->notify(new SendResetPasswordCodeNotification($code));
    }




}
