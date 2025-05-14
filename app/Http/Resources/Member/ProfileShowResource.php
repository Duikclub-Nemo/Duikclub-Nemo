<?php

namespace App\Http\Resources\Member;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileShowResource extends JsonResource
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
            'uuid' => $this->uuid,
            'fullname' => $this->fullname,
            'avatar' => $this->avatar_url,
            'first_name' => $this->first_name,
            'initials' => $this->initials,
            'last_name' => $this->last_name,
            'date_of_birth' => $this->date_of_birth,
            'age' => $this->age,
            'gender' => $this->gender?->getReadableText(),
            'street' => $this->street,
            'zipcode' => $this->zipcode,
            'place' => $this->place,
            'country' => $this->country->code,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'phone_number' => $this->phone_number,
            'about_me' => $this->about_me,
            'certificate' => $this->certificate,
            'medical_check' => $this->medical_check,
            'federation' => $this->federation?->getReadableText(),
            'federation_membership' => $this->federation_membership,
            'dives' => $this->dives ?? 0,
            'ice_name' => $this->ice_name,
            'ice_phone_number' => $this->ice_phone_number,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
