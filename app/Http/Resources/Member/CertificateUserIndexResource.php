<?php

namespace App\Http\Resources\Member;

use App\Enums\FederationEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificateUserIndexResource extends JsonResource
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
            'title' => $this->certificate->title,
            'certificate_type' => $this->certificate->certificate_type->getReadableText(),
            'date_of_issue' => $this->date_of_issue,
            'certificate_number' => $this->certificate_number,
            'federation' => FederationEnum::tryFrom($this->federation ?? 1)->getReadableText(),
        ];
    }
}
