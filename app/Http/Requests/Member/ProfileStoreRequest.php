<?php

namespace App\Http\Requests\Member;

use App\Enums\FederationEnum;
use App\Enums\GenderEnum;
use App\Enums\PermissionEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ProfileStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo(PermissionEnum::PROFILE_EDIT);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(Auth::user()->id), 'max:254'],
            'first_name' => ['required', 'string', 'max:254'],
            'initials' => ['required', 'string', 'max:254'],
            'last_name' => ['required', 'string', 'max:254'],
            'gender' => ['required', new Enum(GenderEnum::class)],
            'date_of_birth' => ['required', 'date'],
            'street' => ['required', 'string', 'max:254'],
            'zipcode' => ['required', 'string', 'max:254'],
            'place' => ['required', 'string', 'max:254'],
            'country_id' => ['required', 'exists:countries,id'],
            'phone_number' => ['nullable', 'phone:INTERNATIONAL,NL'],
            'federation' => ['nullable', new Enum(FederationEnum::class)],
            'federation_membership' => ['nullable', 'string', 'max:254'],
            'medical_check' => ['nullable', 'date', 'before_or_equal:today'],
            'dives' => ['integer'],
            'ice_name' => ['nullable', 'string', 'max:254'],
            'ice_phone_number' => ['nullable', 'phone:INTERNATIONAL,NL'],
        ];
    }

    /**
     * Validation Messages
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'email.unique' => 'Er is al een lid geregistreerd met dit e-mailadres.',
            'email.*' => 'Vul een geldige e-mailadres in.',
            'first_name.*' => 'Vul jouw voornaam in.',
            'initials.*' => 'Vul jouw voorletters in.',
            'last_name.*' => 'Vul jouw voornaam in.',
            'gender.*' => 'Selecteer jouw geslacht.',
            'date_of_birth.*' => 'Vul jouw geboortedatum in.',
            'street.*' => 'Vul jouw straat en huisnummer in.',
            'zipcode.*' => 'Vul jouw postcode in.',
            'place.*' => 'Vul jouw woonplaats in.',
            'country_id' => 'Selecteer het land waar je woont.',
            'phone_number.*' => 'Het ingevulde telefoonnummer klopt niet.',
            'federation' => 'Duikorganisatie niet herkend.',
            'federation_membership' => 'Vul een lidmaatschapsnummer in van de duikorganisatie.',
            'medical_check' => [
                'date' => 'Vul een datum in.',
                'before_or_equal' => 'De datum van de medische keuring kan niet in de toekomst liggen.',
            ],
            'dives.*' => 'Vul een getal in.',
            'ice_name.*' => 'Vul een naam in.',
            'ice_phone_number.*' => 'Het ingevulde telefoonnummer klopt niet.',
        ];
    }

}
