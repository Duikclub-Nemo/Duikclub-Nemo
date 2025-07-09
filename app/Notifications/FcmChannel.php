<?php

namespace App\Notifications;

use App\Services\FcmService;
use Illuminate\Notifications\Notification;

class FcmChannel
{

    public function __construct(protected FcmService $fcmService)
    {
        //
    }

    /**
     * Send the given notification.
     */
    public function send($notifiable, Notification $notification): void
    {
        if (method_exists($notification, 'toFirebase')) {
            $message = $notification->toFirebase($notifiable);

            if (!$message) {
                return;
            }

            $this->fcmService->sendToUser(
                $notifiable,
                $message['data'],
            );

        }
    }

}
