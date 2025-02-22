<?php

namespace Modules\Accounts\Listeners;

use App\Services\SmsService;
use Illuminate\Support\Facades\Storage;
use Modules\Accounts\Entities\Verification;
use Modules\Accounts\Events\VerificationEvent;
use Modules\Accounts\Notifications\VerificationNotification;


class VerificationListener
{
    public $auth_model;
    public $auth_type;
    public $code;
    public $verification_value;


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
     * @param VerificationEvent $event
     * @return void
     */
    public function handle(VerificationEvent $event)
    {
        $this->auth_model = $event->verification->verifiable;
        $this->code = $event->verification->code;
        $this->verification_value = $event->verification->verification_value;

        if ($this->auth_model->hasVerifiedAuth($this->auth_type)) {
            return;
        }

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
            "The verification code for $this->auth_type {$this->verification_value} is {$this->code} generated at " . now()->toDateTimeString() . "\n"
        );
    }



    private function sendEmailNotification()
    {
        return $this->auth_model->notify(new VerificationNotification($this->code));
    }

    private function sendSmsNotification()
    {
        $greetings = trans('accounts::auth.notifications.verification.greeting', [
            'user' => $this->auth_model->name,
        ]);

        $subject = trans('accounts::auth.notifications.verification.subject');

        $line = trans('accounts::auth.notifications.verification.line', [
            'code' => $this->code,
        ]);
        $time = trans('accounts::auth.notifications.verification.time', [
            'minutes' => Verification::EXPIRE_DURATION / 60,
        ]);
        $footer = trans('accounts::auth.notifications.verification.footer');

        $salutation = trans('accounts::auth.notifications.verification.salutation', [
            'app' => env('APP_NAME'),
        ]);

        $message = $greetings . ' ' . $subject . ' ' . $time . ' ' . $line . ' ' . $footer . ' ' . $salutation . ' ' . env('APP_NAME');

        if (env('IS_SMS_LIVE')) {
            $sms_service = app(SmsService::class);
            return $sms_service->sendDreams($this->auth_model->phone, $this->auth_model->name, $message);
        }
    }
}
