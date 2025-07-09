<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AvatarStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('avatar.store');
    }

    public function rules(): array
    {
        return [
            'uuid' => ['required', 'string', 'exists:users,uuid'],
            'avatar' => ['required', 'mimes:jpg,jpeg,png'],
            'height' => ['required', 'string'],
            'width' => ['required', 'string'],
            'left' => ['required', 'string'],
            'top' => ['required', 'string'],
        ];
    }

    /**
     * Validation Messages
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'uuid.*' => 'Er is geen gebruiker gekoppeld',
            'avatar.*' => 'Ongeldige afbeelding',
            'height.*' => 'Vul een wachtwoord in',
            'width.*' => 'Vul een wachtwoord in',
            'left.*' => 'Vul een wachtwoord in',
            'top.*' => 'Vul een wachtwoord in',
        ];
    }

}
