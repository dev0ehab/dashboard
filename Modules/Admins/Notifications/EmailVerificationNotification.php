<?php

namespace Modules\Admins\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;
use Modules\Admins\Entities\PasswordLessLogin;
use Modules\Admins\Entities\Verification;

class EmailVerificationNotification extends Notification
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
            ->greeting(trans('admins::auth.emails.password-less.greeting', [
                'user' => $notifiable->email,
            ]))
            ->subject(trans('admins::auth.emails.password-less.subject'))
            ->line(trans('admins::auth.emails.password-less.line', [
                'code' => $this->code,
            ]))
            ->line(trans('admins::auth.emails.password-less.time', [
                'minutes' => Verification::EXPIRE_DURATION / 60,
            ]))
            ->line(trans('admins::auth.emails.password-less.footer'))
            ->salutation(trans('admins::auth.emails.forget-password.salutation', [
                'app' => Config::get('app.name'),
            ]));
    }
}
