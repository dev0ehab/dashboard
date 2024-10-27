<?php

namespace Modules\Accounts\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\Accounts\Entities\Verification;

class VerificationNotification extends Notification
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
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting(trans('accounts::auth.notifications.verification.greeting', [
                'user' => $notifiable->name,
            ]))
            ->subject(trans('accounts::auth.notifications.verification.subject'))

            ->line(trans('accounts::auth.notifications.verification.line', [
                'code' => $this->code,
            ]))
            ->line(trans('accounts::auth.notifications.verification.time', [
                'minutes' => Verification::EXPIRE_DURATION / 60,
            ]))

            ->line(trans('accounts::auth.notifications.verification.footer'))

            ->salutation(trans('accounts::auth.notifications.verification.salutation', [
                'app' => env('APP_NAME'),
            ]));
    }
}
