<?php

namespace Modules\Accounts\Listeners;


use App\Services\SmsService;
use Illuminate\Support\Facades\Storage;
use Modules\Accounts\Entities\ResetPasswordCode;
use Modules\Accounts\Events\ResetPasswordEvent;
use Modules\Accounts\Notifications\ResetPasswordNotification;


class ResetPasswordListener
{
    private $auth_model;
    private $auth_type;
    private $code;
    private $reset_value;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->auth_type = request()->get('auth_type');
    }

    /**
     * Handle the event.
     *
     * @param ResetPasswordEvent $event
     * @return void
     */
    public function handle(ResetPasswordEvent $event)
    {
        $this->auth_model = $event->resetPasswordCode->resetable;
        $this->code = $event->resetPasswordCode->code;
        $this->reset_value = $event->resetPasswordCode->reset_value;

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
            "The reset password code for $this->auth_type {$this->reset_value} is {$this->code} generated at " . now()->toDateTimeString() . "\n"
        );
    }


    private function sendEmailNotification()
    {
        return $this->auth_model->notify(new ResetPasswordNotification($this->code));
    }

    private function sendSmsNotification()
    {
        $greetings = trans('accounts::auth.notifications.reset-password.greeting', [
            'user' => $this->auth_model->name,
        ]);

        $subject = trans('accounts::auth.notifications.reset-password.subject');

        $line = trans('accounts::auth.notifications.reset-password.line', [
            'code' => $this->code,
        ]);
        $time = trans('accounts::auth.notifications.reset-password.time', [
            'minutes' => ResetPasswordCode::EXPIRE_DURATION / 60,
        ]);
        $footer = trans('accounts::auth.notifications.reset-password.footer');

        $salutation = trans('accounts::auth.notifications.reset-password.salutation', [
            'app' => env('APP_NAME'),
        ]);

        $message = $greetings . ' ' . $subject . ' ' . $time . ' ' . $line . ' ' . $footer . ' ' . $salutation . ' ' . env('APP_NAME');

        if (!env('SMS_TEST_MODE')) {
            $sms_service = app(SmsService::class);
            return $sms_service->sendDreams($this->auth_model->phone, $this->auth_model->name, $message);
        }
    }
}
