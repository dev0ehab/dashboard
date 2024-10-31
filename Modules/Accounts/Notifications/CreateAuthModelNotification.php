<?php

namespace Modules\Accounts\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CreateAuthModelNotification extends Notification
{
    use Queueable;

    /**
     * @var string|int
     */
    private $password;



    /**
     * Create a new notification instance.
     *
     * @param $password
     */
    public function __construct($password)
    {
        $this->password = $password;
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
            ->greeting(trans('accounts::auth.notifications.create-auth-model.greeting', [
                'user' => $notifiable->name,
            ]))
            ->subject(trans('accounts::auth.notifications.create-auth-model.subject'))

            ->line(trans('accounts::auth.notifications.create-auth-model.line'))
            ->line(trans('accounts::auth.notifications.create-auth-model.password', [
                'password' => $this->password,
            ]))

            ->line(trans('accounts::auth.notifications.create-auth-model.footer'))

            ->salutation(trans('accounts::auth.notifications.create-auth-model.salutation', [
                'app' => env('APP_NAME'),
            ]));
    }
}
