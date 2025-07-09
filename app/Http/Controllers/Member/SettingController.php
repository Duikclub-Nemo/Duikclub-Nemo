<?php

namespace App\Http\Controllers\Member;

use App\Http\Resources\Member\UserSettingsEditResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;
use Jenssegers\Agent\Agent;

class SettingController implements HasMiddleware
{
    /**
     * Uses middleware to handle permission in the controller.
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:member.setting.list|member.setting.edit', only: ['edit', 'update']),
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Member/Setting/Edit', [
            'user' => fn() => UserSettingsEditResource::make(auth()->user()),
            'sessions' => $this->sessions($request)->all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        Auth::user()->update([
            'privacy_mode' => $request->privacy_mode,
            'display_userlist' => $request->display_userlist,
        ]);
        return back(303);
    }

    /**
     * Get the current sessions.
     *
     * @param Request $request
     * @return Collection
     */
    protected function sessions(Request $request): Collection
    {
        if (config('session.driver') !== 'database') {
            return collect();
        }

        return collect(
            DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
                ->where('user_id', $request->user()->getAuthIdentifier())
                ->orderBy('last_activity', 'desc')
                ->get()
        )->map(function ($session) use ($request) {
            $agent = new Agent();
            $agent->setUserAgent($session->user_agent);

            return (object)[
                'agent' => [
                    'is_desktop' => $agent->isDesktop(),
                    'platform' => $agent->platform(),
                    'browser' => $agent->browser(),
                ],
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === $request->session()->getId(),
                'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });
    }

}
