<?php

namespace App\Http\Requests\Member;

use App\Enums\CertificateTypeEnum;
use App\Enums\FederationEnum;
use App\Enums\PermissionEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CertificateStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo(PermissionEnum::MEMBER_CERTIFICATE_CREATE);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'certificate_type' => ['required', Rule::enum(CertificateTypeEnum::class)],
            'certificate_id' => ['required', 'exists:certificates,id'],
            'date_of_issue' => ['required', 'date'],
            'certificate_number' => ['nullable', 'min:3', 'max:254'],
            'federation' => ['required', Rule::enum(FederationEnum::class)],
        ];
    }

    /**
     * Validation Messages
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'certificate_type.*' => 'Selecteer een brevettype.',
            'certificate_id.*' => 'Selecteer een brevet.',
            'date_of_issue.*' => 'Vul een geldige datum in.',
            'certificate_number.*' => 'Vul een waarde met tussen de 3 en 254 tekens.',
            'federation.*' => 'Selecteer een organisatie.',
        ];
    }

}
