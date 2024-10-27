<?php

namespace Modules\Accounts\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Accounts\Entities\ResetPasswordCode;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * @var string|int
     */
    private $code;

    /**
     * Create a new notification instance.
     *
     * @param $code
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting(trans('accounts::auth.notifications.reset-password.greeting', [
                'user' => $notifiable->name,
            ]))
            ->subject(trans('accounts::auth.notifications.reset-password.subject'))

            ->line(trans('accounts::auth.notifications.reset-password.line', [
                'code' => $this->code,
            ]))
            ->line(trans('accounts::auth.notifications.reset-password.time', [
                'minutes' => ResetPasswordCode::EXPIRE_DURATION / 60,
            ]))

            ->line(trans('accounts::auth.notifications.reset-password.footer'))

            ->salutation(trans('accounts::auth.notifications.reset-password.salutation', [
                'app' => env('APP_NAME'),
            ]));
    }
}
