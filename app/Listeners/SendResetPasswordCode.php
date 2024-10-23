<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Storage;
use App\Events\ResetPasswordCreated;


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
        $model = $event->resetPasswordCode->resetable;
        $verificationType = defined(get_class($model) . '::VerificationType') ? $model::VerificationType : 'phone';
        switch ($verificationType) {
            case 'email':
                $this->sendEmailNotification($model, $event->resetPasswordCode->code);
                break;
            case 'phone':
                $this->sendSmsNotification($model, $event->resetPasswordCode->code);
                break;
            default:
                # code...
                break;
        }

        /* @deprecated */
        Storage::disk('public')->append(
            'resetPassword.txt',
            "The reset password code for phone {$event->resetPasswordCode->username} is {$event->resetPasswordCode->code} generated at " . now()->toDateTimeString() . "\n"
        );
    }


    private function sendEmailNotification($model, $code)
    {
        // dd("email");
        // $model->notify(new SendResetPasswordCodeNotification($code));
    }

    private function sendSmsNotification($model, $code)
    {
        // dd("phone");
        // $model->notify(new SendResetPasswordCodeNotification($code));
    }




}
