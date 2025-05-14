<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'avatar' => $this->avatar_url,
            'fullname' => $this->fullname,
            'certificate' => $this->certificate,
            'place' => $this->place,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
        ];
    }
}
