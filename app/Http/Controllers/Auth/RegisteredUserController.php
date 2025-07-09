<?php

namespace App\Http\Controllers\Auth;

use App\Enums\FederationEnum;
use App\Enums\GenderEnum;
use App\Events\RegisteredUserEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisteredUserRequest;
use App\Models\Setting;
use App\Models\User;
use App\Repositories\CertificateRepository;
use App\Repositories\CountryRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register', [
            'genders' => GenderEnum::getSelectList(),
            'countries' => CountryRepository::getSelectList(),
            'certifications' => CertificateRepository::getSelectList(),
            'federations' => FederationEnum::getSelectList(),
            'terms_date' => Carbon::parse(Setting::get('terms_date'))->isoFormat('dddd D MMMM Y'),
            'terms' => Setting::get('terms'),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException|Throwable
     */
    public function store(RegisteredUserRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $user = User::create([
                'uuid' => Str::uuid(),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'first_name' => $request->first_name,
                'initials' => $request->initials,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'street' => $request->street,
                'zipcode' => $request->zipcode,
                'place' => $request->place,
                'country_id' => $request->country_id,
                'phone_number' => $request->phone_number,
                'medical_check' => $request->medical_check,
                'dives' => $request->dives,
                'federation' => $request->federation,
                'federation_membership' => $request->federation_membership,
                'ice_name' => $request->ice_name,
                'ice_phone_number' => $request->ice_phone_number,
                'privacy_mode' => $request->privacy_mode,
                'display_userlist' => $request->display_userlist,
                'accepted_terms' => NOW()
            ]);

            if ($request->certification) {
                $user->certificates_regular()->attach($request->certification,
                    [
                        'date_of_issue' => $request->certification_date,
                        'certificate_number' => $request->certificate_number,
                        'federation' => $request->federation,
                        'created_by' => $user->id,
                    ]);
            }

            event(new RegisteredUserEvent($user));

        });

        return redirect(route('login', absolute: false))->with(
            'status', 'Jouw account is aangemaakt, maar zal eerst geaccepteerd moeten worden door het bestuur. Je ontvangt hiervan zo snel mogelijk een e-mailbericht.'
        );
    }

}
