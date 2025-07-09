<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class NotificationSettingsController extends Controller implements HasMiddleware
{
    /**
     * Uses middleware to handle permission in the controller.
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:member.setting.edit', only: ['update']),
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        Auth::user()->update([
            'notify_push_admin' => $request->notify_push_admin,
            'notify_mail_admin' => $request->notify_mail_admin,
            'notify_push_news_added' => $request->notify_push_news_added,
            'notify_mail_news_added' => $request->notify_mail_news_added,
            'notify_push_news_edited' => $request->notify_push_news_edited,
            'notify_mail_news_edited' => $request->notify_mail_news_edited,
            'notify_push_activity_added' => $request->notify_push_activity_added,
            'notify_mail_activity_added' => $request->notify_mail_activity_added,
            'notify_push_activity_edited' => $request->notify_push_activity_edited,
            'notify_mail_activity_edited' => $request->notify_mail_activity_edited,
            'notify_push_activity_removed' => $request->notify_push_activity_removed,
            'notify_mail_activity_removed' => $request->notify_mail_activity_removed,
            'notify_push_activity_reminder' => $request->notify_push_activity_reminder,
            'notify_mail_activity_reminder' => $request->notify_mail_activity_reminder,
            'notify_push_activity_reminder_minutes_before' => $request->notify_push_activity_reminder_minutes_before,
            'notify_mail_activity_reminder_minutes_before' => $request->notify_mail_activity_reminder_minutes_before,
            'notify_push_subscription_added' => $request->notify_push_subscription_added,
            'notify_mail_subscription_added' => $request->notify_mail_subscription_added,
            'notify_push_subscription_edited' => $request->notify_push_subscription_edited,
            'notify_mail_subscription_edited' => $request->notify_mail_subscription_edited,
            'notify_push_subscription_removed' => $request->notify_push_subscription_removed,
            'notify_mail_subscription_removed' => $request->notify_mail_subscription_removed,
        ]);

        return back(303);
    }
}
