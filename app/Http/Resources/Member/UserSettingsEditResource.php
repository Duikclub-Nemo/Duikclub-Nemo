<?php

namespace App\Http\Resources\Member;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSettingsEditResource extends JsonResource
{

    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'privacy_mode' => $this->privacy_mode,
            'display_userlist' => $this->display_userlist,
            'notify_push_admin' => $this->notify_push_admin,
            'notify_mail_admin' => $this->notify_mail_admin,
            'notify_push_news_added' => $this->notify_push_news_added,
            'notify_mail_news_added' => $this->notify_mail_news_added,
            'notify_push_news_edited' => $this->notify_push_news_edited,
            'notify_mail_news_edited' => $this->notify_mail_news_edited,
            'notify_push_activity_added' => $this->notify_push_activity_added,
            'notify_mail_activity_added' => $this->notify_mail_activity_added,
            'notify_push_activity_edited' => $this->notify_push_activity_edited,
            'notify_mail_activity_edited' => $this->notify_mail_activity_edited,
            'notify_push_activity_removed' => $this->notify_push_activity_removed,
            'notify_mail_activity_removed' => $this->notify_mail_activity_removed,
            'notify_push_activity_reminder' => $this->notify_push_activity_reminder,
            'notify_mail_activity_reminder' => $this->notify_mail_activity_reminder,
            'notify_push_activity_reminder_minutes_before' => $this->notify_push_activity_reminder_minutes_before,
            'notify_mail_activity_reminder_minutes_before' => $this->notify_mail_activity_reminder_minutes_before,
            'notify_push_subscription_added' => $this->notify_push_subscription_added,
            'notify_mail_subscription_added' => $this->notify_mail_subscription_added,
            'notify_push_subscription_edited' => $this->notify_push_subscription_edited,
            'notify_mail_subscription_edited' => $this->notify_mail_subscription_edited,
            'notify_push_subscription_removed' => $this->notify_push_subscription_removed,
            'notify_mail_subscription_removed' => $this->notify_mail_subscription_removed,
        ];
    }
}
