<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisteredUserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public string $url;

    /**
     * Create a new notification instance.
     */
    public function __construct(public User $user)
    {
        $this->url = route('admin.user.activate', $user->uuid);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $channels = ['database', 'broadcast'];

        if ($notifiable->notify_mail_admin) {
            $channels[] = 'mail';
        }
        if ($notifiable->notify_push_admin) {
            $channels[] = FcmChannel::class;
        }

        return $channels;
    }

    /**
     * Get the Mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Duikclub Nemo | Er is een nieuw lid geregistreerd.')
            ->view('emails.registered-user', [
                'notifiable' => $notifiable,
                'user' => $this->user,
                'url' => $this->url,
            ]);
    }

    /**
     * Get the Database representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(): array
    {
        return [
            'title' => 'Er is een nieuw lid geregistreerd.',
            'message' => $this->user->first_name . ' ' . $this->user->last_name . ' heeft zich geregistreerd op de website.',
            'url' => $this->url,
        ];
    }

    /**
     * Get the Broadcast representation of the notification.
     *
     * @return BroadcastMessage
     */
    public function toBroadcast(): BroadcastMessage
    {
        return new BroadcastMessage([
            'title' => 'Er is een nieuw lid geregistreerd.',
            'message' => $this->user->first_name . ' ' . $this->user->last_name . ' heeft zich geregistreerd op de website.',
            'style' => 'info',
            'duration' => 3000,
            'url' => $this->url,
        ]);
    }

    /**
     * Get the Firebase representation of the notification.
     */
    public function toFirebase(): array
    {
        return [
            'data' => [
                'title' => 'Er is een nieuw lid geregistreerd.',
                'body' => $this->user->first_name . ' ' . $this->user->last_name . ' heeft zich geregistreerd op de website.',
                'url' => $this->url,
                'messageId' => uniqid('user_reg_'),
                'imageUrl' => '/images/apple-touch-icon.png',
            ],
        ];
    }

}
