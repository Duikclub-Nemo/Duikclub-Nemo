<?php

namespace App\Http\Controllers\Member;

use App\Enums\FederationEnum;
use App\Enums\GenderEnum;
use App\Http\Requests\Member\ProfileStoreRequest;
use App\Http\Resources\Member\ProfileEditResource;
use App\Http\Resources\Member\ProfileShowResource;
use App\Repositories\CountryRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Stevebauman\Purify\Facades\Purify;

class ProfileController implements HasMiddleware
{
    /**
     * Uses middleware to handle permission in the controller.
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:profile.view|profile.edit|profile.delete', only: ['show']),
            new Middleware('permission:profile.edit', only: ['edit', 'update']),
            new Middleware('permission:profile.delete', only: ['destroy']),

        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(): Response
    {
        return Inertia::render('Member/Profile/Show', [
            'user' => fn() => ProfileShowResource::make(auth()->user()->load('certificates_regular', 'certificates_specialties')),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(): Response
    {
        return Inertia::render('Member/Profile/Edit', [
            'user' => fn() => ProfileEditResource::make(auth()->user()),
            'genders' => fn() => GenderEnum::getSelectList(),
            'countries' => fn() => CountryRepository::getSelectList(),
            'federations' => fn() => FederationEnum::getSelectList(),
            'ckeditorLicenseKey' => fn() => config('services.ckeditor.license_key'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileStoreRequest $request)
    {
        $request->user()->fill([
            'first_name' => $request->first_name,
            'initials' => $request->initials,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'street' => $request->street,
            'zipcode' => $request->zipcode,
            'place' => $request->place,
            'country_id' => $request->country_id,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'medical_check' => $request->medical_check,
            'dives' => $request->dives,
            'federation' => $request->federation,
            'federation_membership' => $request->federation_membership,
            'ice_name' => $request->ice_name,
            'ice_phone_number' => $request->ice_phone_number,
            'about_me' => Purify::clean($request->about_me),
        ]);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->updated_at = Now();
        $request->user()->updated_by = Auth::user()->id;
        $request->user()->save();

        return redirect(route('member.profile.show'))->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Je profiel is gewijzigd.',
                'duration' => 2000,
            ]
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'required',
        ], [
            'password.required' => 'Vul een wachtwoord in.',
        ]);

        if (!Hash::check($request->password, Auth::user()->getAuthPassword())) {
            throw ValidationException::withMessages([
                'password' => 'Het opgegeven wachtwoord is onjuist.',
            ]);
        }

        $currentUser = Auth::user();

        $currentUser->update([
                'deleted_at' => Now(),
                'deleted_by' => $currentUser->id,
            ]
        );

        $currentUser->fcmTokens()->delete();

        DB::table('certificate_user')
            ->where('user_id', $currentUser->id)
            ->update(
                [
                    'deleted_at' => Now(),
                    'deleted_by' => $currentUser->id,
                ]);

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('home'))->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Je profiel is verwijderd',
                'duration' => 2000,
            ]
        ]);

    }

}
