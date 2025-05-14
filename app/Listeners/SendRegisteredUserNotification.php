<?php

namespace App\Listeners;

use App\Enums\RoleEnum;
use App\Events\RegisteredUserEvent;
use App\Models\User;
use App\Notifications\RegisteredUserNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendRegisteredUserNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RegisteredUserEvent $event): void
    {
        $admins = User::active()
            ->role([RoleEnum::SUPER_ADMIN, RoleEnum::ADMIN])
            ->get();

        foreach ($admins as $admin) {
            Notification::send($admin, new RegisteredUserNotification($event->user));
        }
    }
}
