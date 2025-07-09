<?php

namespace App\Http\Resources\Member;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileEditResource extends JsonResource
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
            'first_name' => $this->first_name,
            'initials' => $this->initials,
            'last_name' => $this->last_name,
            'date_of_birth' => $this->date_of_birth?->format('Y-m-d'),
            'age' => $this->age,
            'gender' => $this->gender,
            'street' => $this->street,
            'zipcode' => $this->zipcode,
            'place' => $this->place,
            'country_id' => $this->country->id,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'about_me' => $this->about_me,
            'certificate' => $this->certificate,
            'medical_check' => $this->medical_check?->format('Y-m-d'),
            'federation' => $this->federation,
            'federation_membership' => $this->federation_membership,
            'dives' => $this->dives ?? 0,
            'ice_name' => $this->ice_name,
            'ice_phone_number' => $this->ice_phone_number,
        ];
    }
}
