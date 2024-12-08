<?php

namespace Modules\Accounts\Listeners;


use App\Services\SmsService;
use Modules\Accounts\Events\ChangePasswordEvent;
use Modules\Accounts\Notifications\ChangePasswordNotification;


class ChangePasswordListener
{
    public $auth_model;
    public $password;
    public $auth_type;


    /**
     * Handle the event.
     *
     * @param ChangePasswordEvent $event
     * @return void
     */
    public function handle(ChangePasswordEvent $event)
    {
        $class = $event->class;
        $id = $event->id;
        $this->auth_model = $class::find($id);
        $this->password = $event->password;
        $this->auth_type = $class::AuthType;

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
    }


    private function sendEmailNotification()
    {
        return $this->auth_model->notify(new ChangePasswordNotification($this->password));
    }

    private function sendSmsNotification()
    {
        $greetings = trans('accounts::auth.notifications.change-password.greeting', [
            'user' => $this->auth_model->name,
        ]);

        $subject = trans('accounts::auth.notifications.change-password.subject');

        $line = trans('accounts::auth.notifications.change-password.line');

        $password = trans('accounts::auth.notifications.change-password.time', [
            'password' => $this->password,
        ]);
        $footer = trans('accounts::auth.notifications.change-password.footer');

        $salutation = trans('accounts::auth.notifications.change-password.salutation', [
            'app' => env('APP_NAME'),
        ]);

        $message = $greetings . ' ' . $subject . ' ' . $password . ' ' . $line . ' ' . $footer . ' ' . $salutation . ' ' . env('APP_NAME');

        if (env('IS_SMS_LIVE')) {
            $sms_service = app(SmsService::class);
            return $sms_service->sendDreams($this->auth_model->phone, $this->auth_model->name, $message);
        }
    }




}
