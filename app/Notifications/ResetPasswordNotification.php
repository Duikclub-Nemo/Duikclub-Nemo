<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    /**
     * Create a new notification instance.
     */
    public function __construct(protected string $token)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {

        return (new MailMessage)
            ->subject('Duikclub Nemo | Wachtwoord herstellen')
            ->view('emails.reset-password', [
                'notifiable' => $notifiable,
                'url' => route('password.reset', ['token' => $this->token, 'email' => $notifiable->email])
            ]);
    }

}
